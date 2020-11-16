<?php
namespace Deployer;

require 'recipe/symfony.php';



set('env', function () {
    return [
        'SYMFONY_ENV' => get('symfony_env')
    ];
});

set('application', 'espace-client-api');
set('repository', 'git@bitbucket.org:cafpi/espace-client-web.git');
set('git_tty', true);
set('ssh_multiplexing', true);

set('bin_dir', 'bin');
set('var_dir', 'var');

set('shared_dirs', ['var/log', 'var/sessions']);
set('shared_files', ['.env.local.php', '.env.local']);
set('writable_dirs', ['var']);
set('migrations_config', '');

set('dump_assets', false);
set('writable_mode', "chmod");
set('assets', ['public/css', 'public/images', 'public/js']);
set('bin/console', function () {
    return parse('{{release_path}}/bin/console');
});
set('console_options', function () {
    return '--no-interaction';
});

// Hosts
host("PREPROD WEBAPP AZURE")
    ->hostname("localhost")
    ->stage('staging')
    ->identityFile('id_rsa')
    ->user("root")
    ->port(9100)
    ->set('deploy_path', '/home/site/wwwroot/{{application}}')
    ->set('http_user', 'www-data');



/**
 * Migrate database
 */
task('database:migrate', function () {
})->desc('Migrate database');


task('deploy:cache:clear', function () {
    run('{{bin/php}} {{bin/console}} cache:clear {{console_options}} --no-warmup');
})->desc('Clear cache');


task('deploy:cache:warmup', function () {
    run('{{bin/php}} {{bin/console}} cache:warmup {{console_options}}');
})->desc('Warm up cache');

/**
* Install assets from public dir of bundles
*/
task('deploy:assets:install', function () {
    run('{{bin/php}} {{bin/console}} assets:install {{console_options}} {{release_path}}/public');
})->desc('Install bundle assets');


// Tasks
task('build', function () {
    run('cd {{release_path}} && build');
});



// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
before('deploy:symlink', 'database:migrate');
