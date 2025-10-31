<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackupDatabase extends Command
{
    protected $signature = 'backup:database';
    protected $description = 'Создаёт бэкап базы данных и отправляет на удалённый сервер.';

    public function handle()
    {
        $backupDir = config('backup.backup_dir');
        $retentionDays = config('backup.retention_days');

        $connection = config('database.default');
        $db = config("database.connections.$connection");

        $dbHost = $db['host'];
        $dbPort = $db['port'];
        $dbName = $db['database'];
        $dbUser = $db['username'];
        $dbPass = $db['password'];

        $rsync = config('backup.rsync');
        $rsyncUser = $rsync['user'] ?? null;
        $rsyncPass = $rsync['password'] ?? null;
        $rsyncHost = $rsync['host'] ?? null;
        $rsyncPath = $rsync['path'] ?? null;

        $this->info("Удаляем старые бэкапы...");

        $files = glob("$backupDir/*.sql");
        if (count($files) > 30) {
            usort($files, fn($a, $b) => filemtime($a) <=> filemtime($b));

            $toDelete = array_slice($files, 0, count($files) - 30);

            foreach ($toDelete as $file) {
                unlink($file);
                $this->line("Удалён старый файл: " . basename($file));
            }
        }

        $this->info("Очистка завершена");

        $date = date('Y-m-d_H-i-s');
        $filename = "$backupDir/db_{$date}.sql";

        $this->info("Создаём дамп базы...");
        $dump = "mysqldump -h $dbHost -P $dbPort -u $dbUser -p'$dbPass' $dbName > $filename";
        exec($dump, $output, $code);

        if ($code !== 0) {
            $this->error("Ошибка при создании дампа!");
            return 1;
        }

        $this->info("Дамп создан: $filename");

        if ($rsyncUser && $rsyncHost && $rsyncPath) {
            $this->info("Отправляем файл на сервер...");

            // Лог-файл для rsync
            $logFile = storage_path('logs/rsync.log');
            $this->line("Лог rsync будет записан в: $logFile");

            if (!empty($rsyncPass)) {
                $rsyncCommand = "/usr/bin/sshpass -p '$rsyncPass' /usr/bin/rsync -avz --progress $filename $rsyncUser@$rsyncHost::$rsyncPath 2>&1";
            } else {
                $rsyncCommand = "/usr/bin/rsync -avz --progress $filename $rsyncUser@$rsyncHost:$rsyncPath 2>&1";
            }

            $this->line("Выполняется команда: $rsyncCommand");

            exec($rsyncCommand, $rsyncOutput, $rsyncCode);

            file_put_contents($logFile, "=== " . date('Y-m-d H:i:s') . " ===\n" . $rsyncCommand . "\n" . implode("\n", $rsyncOutput) . "\n\n", FILE_APPEND);

            foreach ($rsyncOutput as $line) {
                $this->line("→ $line");
            }

            if ($rsyncCode !== 0) {
                $this->error("Ошибка при передаче! Код: $rsyncCode");
                return 1;
            }

            $this->info("Файл успешно передан.");
        } else {
            $this->warn("Данные rsync не заданы - файл не отправлен.");
        }

        $this->info("Копирование завершено успешно.");
        return 0;
    }
}
