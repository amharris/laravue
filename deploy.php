<?php

namespace Deployer;

require 'recipe/laravel.php';
require 'contrib/rsync.php';

set('application', 'Laravel App');
set('ssh_multiplexing', true);

set('rsync_src', function () {
    return __DIR__;
});

host('production')
  ->setHostname(getenv('SSH_HOST'))
  ->setPort(getenv('SSH_PORT'))
  ->setTag('production')
  ->setRemoteUser(getenv('SSH_USER'))
  ->setDeployPath(getenv('DEPLOY_PATH'));

add('rsync', [
    'exclude' => [
        '.git',
        '/.env',
        '/storage/',
        '/vendor/',
        '/node_modules/',
        '.github',
        'deploy.php',
    ],
]);

task('deploy:secrets', function () {
    file_put_contents(__DIR__ . '/.env', getenv('DOT_ENV'));
    upload('.env', get('deploy_path'));
});

after('deploy:failed', 'deploy:unlock');

desc('Deploy the application');

task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'rsync',
    'deploy:secrets',
    'deploy:shared',
    'deploy:vendors',
    'deploy:writable',
    'artisan:storage:link',
    'artisan:view:cache',
    'artisan:config:cache',
    'artisan:migrate',
    'artisan:queue:restart',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
]);