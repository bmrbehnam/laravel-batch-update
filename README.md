
# Laravel Batch Update

This is a Trait Helper that by use this trait in Models add BatchUpdate Method in It.



# How To Use It ?

1.Add This Line in Your Model :

    use BatchUpdateTrait;

2. Ready ! Use It :

        # Example Data For Update By One Update Query
        $data = [
            ['id' => 1, 'level' => 1, 'name' => 'category one'],
            ['id' => 2, 'level' => 2, 'name' => 'category two'],
            ['id' => 4, 'level' => 5, 'name' => 'category three'],
        ];


        Category::batchUpdate($data);