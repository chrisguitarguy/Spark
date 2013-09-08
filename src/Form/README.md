# Forms

Spark tries to help you automate the building of forms.

## Low Level Example

Form Creation

    use Spark\Form;

    $view_factory = new View\ViewFactory(...);
    $form = new Form\Form($view_factory);

    $form->add(new Form\Field\Field('some_name', new Form\Widget\TextWidget(), array(
        'label'     => __('A Label', 'your_textdomain'),
    )));

Normal HTML

    ```
    $form_view = $form->createView('html'); // $view instanceof Spark\Form\View\HtmlView

    // somewhere in the page...
    <html>
    <head>
        <?php echo $form_view->renderStyles(); ?>
        <?php echo $form_view->renderScripts(); ?>
    </head>
    <body>
        <?php echo $form_view->render(); ?>
    </body>
    </html>

Meta boxes

    $form_view = $form->createView('metabox'); // $view instanceof Spark\Form\View\MetaBoxView

    add_action('add_meta_boxes', function () use ($form_view) {
        add_meta_box(
            'id',
            __('Title', 'asdf'),
            array($form_view, 'render'),
            'post',
            'advanced',
            'high'
        );
    });

    add_action('save_post', function ($post_id, $post) use ($form) {
        // make sure the user can do stuff...

        $form->bind($_POST);

        if ($form->isValid()) {
            foreach ($form->getFields() as $field) {
                update_post_meta($post_id, $field->getName(), $field->getValue());
            }
        }
    }, 10, 2;
