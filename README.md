# laravel-sql-optimisation
laravel sql optimisation

Setup:

1. make setup   // with SQLite
2. make server // start local server 127.0.0.1:8000

При желании можно развернуть любую другую базу с sail.

Добавлена группировка от типа базы данных (SQLite, MySql, PostPres):

        $groupTags = 'GROUP_CONCAT(tags.name,\', \') as tag_names';

        switch (config('database.default')) {
            case 'mysql':
                $groupTags = 'GROUP_CONCAT(tags.name SEPARATOR \', \') as tag_names';
                break;
            case 'pgsql':
                $groupTags = 'STRING_AGG(tags.name,\', \') as tag_names';
                break;
        }

        $posts = Post::SelectRaw( 'posts.id, posts.title, posts.text, '.$groupTags)
            ->leftJoin('post_tag', 'posts.id', '=', 'post_tag.post_id')
            ->leftJoin('tags', 'post_tag.tag_id', '=', 'tags.id')
            ->groupBy('posts.id')->get();
