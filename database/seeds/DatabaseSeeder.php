<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    protected static $seeders = [
        'UsersTableSeeder',
        'LinksTableSeeder',
        'CategoriesTableSeeder',
        'TopicsTableSeeder',
        'RepliesTableSeeder',
        'BannersTableSeeder',
        'FollowersTableSeeder',
        'ActiveUsersTableSeeder',
        'HotTopicsTableSeeder',
        'SitesTableSeeder',
        'OauthClientsTableSeeder',
        'TodosTableSeeder',
        'TaskTableSeeder',
    ];

    public function run()
    {
        insanity_check();

        Model::unguard();

        foreach (self::$seeders as $seedClass) {
            $this->call($seedClass);
        }

        Model::reguard();
    }
}
