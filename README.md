
# Laravel Batch Update

this is a helper that by use this trait in models add Batch Update method in it.

this method run multi update query in one query.



# How To Use It ?

1. Install package by composer :

    composer require bmrbehnam/laravel-batch-update


2.Add this line in your model :

    use BatchUpdate\BatchUpdateTrait;


3. Ready ! use it :

        # Example data for update by one update query
        $data = [
            ['id' => 1, 'level' => 1, 'name' => 'category one'],
            ['id' => 2, 'level' => 2, 'name' => 'category two'],
            ['id' => 4, 'level' => 5, 'name' => 'category three'],
        ];


	# Batch update 
        Category::batchUpdate($data);

        # Or any model
        Post::batchUpdate($data);


        # Use by custom condition key by default condition key is model primary key field

        $data = [
            ['slug' => 'behnam', 'level' => 1, 'name' => 'category one'],
            ['slug' => 'nima', 'level' => 2, 'name' => 'category two'],
            ['slug' => 'hamed', 'level' => 5, 'name' => 'category three'],
        ];

        # Update level and name field in one query
        Category::batchUpdate($data,'slug');
