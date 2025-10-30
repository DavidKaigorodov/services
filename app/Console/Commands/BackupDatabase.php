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
        $rsyncUser = $rsync['user'];
        $rsyncPass = $rsync['password'];
        $rsyncHost = $rsync['host'];
        $rsyncPath = $rsync['path'];

        if (!file_exists($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        $this->info("Удаляем старые бэкапы...");
        $cleanup = "find $backupDir -type f -name '*.sql' -mtime +$retentionDays -delete";
        exec($cleanup);
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

            if (!empty($rsyncPass)) {
                $rsyncCommand = "sshpass -p '$rsyncPass' rsync -av " . getcwd() . "/ $rsyncUser@$rsyncHost::$rsyncPath";
            } else {
                $rsyncCommand = "rsync -avz $filename $rsyncUser@$rsyncHost:$rsyncPath";
            }
            // dd($rsyncCommand);
            exec($rsyncCommand, $rsyncOutput, $rsyncCode);

            if ($rsyncCode !== 0) {
                $this->error("Ошибка при передаче!");
                return 1;
            }

            $this->info("Файл передан.");
        } else {
            $this->warn("Данные rsync не заданы - файл не отправлен.");
        }

        $this->info("Копирование завершено успешно.");
        return 0;
    }
}
