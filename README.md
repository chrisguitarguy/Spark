# Spark

Spark is a framework for getting things done fast with WordPrss.

It's a work in progress.

## Using Spark

Spark is a plugin, so if you want to use it, it's best to make sure it's loaded
first. Hook into `spark_loaded` to get started, which will get an instance of
`Spark\Spark` as it's only argument.

    <?php
    add_action('spark_loaded', function(\Spark\Spark $spark) {
        // do stuff
    });

`Spark\Spark` is a subclass of [`Pimple`](http://pimple.sensiolabs.org/) and
doubles as a service locator. Spark also happens to use itself for things like
autoloading and such.

To get your own intance of spark simply call the `get` method. This might look
something like this.

    <?php
    add_action('spark_loaded', function(\Spark\Spark $spark) {
        $my_spark = $spark->get('my_spark);

        // $my_spark is now your own instance of spark
        // you can pass it into the constructor(s) or your plugin class(es)
        // use it however you wish.
        MyPluginClass::doStuff($my_spark);
    });

You can also get your instance of `Spark\Spark` back two other ways...

    $my_spark = \Spark\Spark::get('my_spark');
    $my_spar = spark('my_spark');

For the purpose of this readme, I'll use the global `spark` function. Please
don't do this in your plugins or themes! Pass your instance of `Spark\Spark`
into your plugin classes constructors instead.

## Post Types and Taxonomies

The hard way...

    <?php
    $type = (new \Spark\Type\PostType())
        ->setSingularName(__('Type', 'your_td'))
        ->setPluralName(__('Types', 'your_td'))
        ->setLabel('menu_name', __('Here we Are', 'your_td'))
        ->setSlug('some_type');

    $type['rewrite'] = array(
        'slug'  => 'some-slug',
    );

    $type->register();

The above could be done somewhere hooked into `init`.

You could also use Spark's type manager, which will take care of registering
things for you. There's a few ways to do this.

You may create your own type manually, then put it into the TypeManager.

    <?php
    $type = (new \Spark\Type\PostType())
        ->setSingularName(__('Type', 'your_td'))
        ->setPluralName(__('Types', 'your_td'))
        ->setLabel('menu_name', __('Here we Are', 'your_td'))
        ->setSlug('some_type');

    $type['rewrite'] = array(
        'slug'  => 'some-slug',
    );

    $my_spark = spark('my_spark');
    $my_spark['types.post']->put($type);

    // for taxonomies...
    $type = (new \Spark\Type\Taxonomies())
        ->setSingularName(__('Type', 'your_td'))
        ->setPluralName(__('Types', 'your_td'))
        ->setLabel('menu_name', __('Here we Are', 'your_td'))
        ->setSlug('some_type');

    $type['rewrite'] = array(
        'slug'  => 'some-slug',
    );
    $type['object_type'] = array('a_type', 'post');

    $my_spark = spark('my_spark');
    $my_spark['types.taxonomy']->put($type);

Or you can implement `Spark\Type\TypeBuilderInterface`...

    <?php
    class MyBuilder implements \Spark\Type\TypeBuilderInterface
    {
        public function build(\Spark\Type\TypeInterface $type)
        {
            $type
                ->setSlug('movies')
                ->setSingularName(__('Movie', 'your_td'))
                ->sePluralName(__('Movies', 'your_td'))
                ->setArguments(array(
                    'rewrite'       => array(
                        'slug'  => 'movie',
                    ),
                    'has_archive'   => true,
                ));
        }
    }

    class MyTaxonomyBuilder implements \Spark\Type\TypeBuilderInterface
    {
        public function build(\Spark\Type\TypeInterface $type)
        {
            $type
                ->setSlug('movies')
                ->setSingularName(__('Movie', 'your_td'))
                ->sePluralName(__('Movies', 'your_td'))
                ->setArguments(array(
                    'rewrite'       => array(
                        'slug'  => 'movie',
                    ),
                    'has_archive'   => true,
                ));

            $type['object_type'] = array('post', 'page');
        }
    }

    // some other file
    add_action('doings_loaded', function(\Spark\Spark $spark) {
        $my_spark = $spark->get('my_spark');

        $my_spark['types.post']->create(new MyBuilder());
        $my_spark['types.taxonomy']->create(new MyTaxonomyBuilder());
    });

Type type manager will take care of hook into `init` and registering your types
for you. Which means, you just need to make sure to add your builders or types
at some point before `init` (like the example above).

## Meta

Spark provides a nice wrapper around the metadata API that automatically
prefixes things for you.

    $spark = spark('my_spark');

    // equivalent to get_post_meta($some_post_id, '_my_spark_a_key', true)
    $val = $spark['meta.post']->get($some_post_id, 'a_key');

    // update_meta_meta($some_post_id, '_my_spark_a_key', 'a value');
    $spark['meta.post']->save($some_post_id, 'a_key', 'a value');

    // delete_post_meta($some_post_id, '_my_spark_a_key');
    $spark['meta.post']->delete($some_post_id, 'a_key');

You can use `meta.post`, `meta.user`, and `meta.comment` all in the same way.

## Forms

todo

## Settings Fields/Pages

todo

## Meta Boxes

todo

## Taxonomy Fields

todo

## User Fields

todo

## Running the Tests

Spark tests require PHPUnit and WordPress' unit test suite (learn about it
[here](http://make.wordpress.org/core/handbook/automated-testing/).

To use WordPress' unit test suite, you must install PHPUnit via PEAR, or put
PHPUnit someplace that gets registerd with your include path.
