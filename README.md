
# Laravel Batch Update

this is a trait helper that by use this trait in models add BatchUpdate method in it.

this method run multi update query in one query.



# How To Use It ?

1.add this line in your model :

    use BatchUpdateTrait;

2. Ready ! use it :

        # Example Data For Update By One Update Query
        $data = [
            ['id' => 1, 'level' => 1, 'name' => 'category one'],
            ['id' => 2, 'level' => 2, 'name' => 'category two'],
            ['id' => 4, 'level' => 5, 'name' => 'category three'],
        ];


        Category::batchUpdate($data);

        # Or Any Model
        Post::batchUpdate($data);


        # Use by Custom Condition Key

        $data = [
            ['slug' => 'behnam', 'level' => 1, 'name' => 'category one'],
            ['slug' => 'nima', 'level' => 2, 'name' => 'category two'],
            ['slug' => 'hamed', 'level' => 5, 'name' => 'category three'],
        ];

        # Update level and name field in one query
        Category::batchUpdate($data,'slug');