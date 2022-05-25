
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