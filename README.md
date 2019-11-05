# Form Config

There are a number of options when building forms, below is a breakdown of what options you have and field types that can be added.

## Options

These options are required by the form plugin to setup a form for you. They belong in your `.config.yml` file under the `forms` key.

```yaml
forms:
    my-form: # This is your form ID
        remote: <key> # If this form is handled by our remote API, the key goes here and the below options are configured remotely.
        name: Contact Form # This is the name of the form
        email: true # Should the result be sent in an e-mail?
        db: false # Should the result be stored in a database?
        autoresponder: true # Should the user get a thank you message?
        recipient: chris@resknow.co.uk # Where to send the form to
        subject: New message # The subject line of the e-mail
        subject_autoresponder: Thank you # The subject line of the autoresponse
        success_message: Your message has been sent # Message to display when the form is submitted successfully
        location: /thanks # URL to direct users to after successfully submitting the form
        submit: # Submit button options
            text: Submit
            classes: button positive

        fields:
            ...
 ```

## Fields

Fields are defined under the `fields` key of your form's configuration. There are a number of field types, which are listed below along with their available options.

Most field types support HTML attributes as options too.

#### Text field
```yaml

    # Text field
    name: # This is the field key (HTML name attribute)

        ### Required ###
        label: Name # Label
        type: text # Input type

        ### Optional ###
        show_label: false # Whether to display the label above the field (defaults to true)
        validate: required # Validation rules {see: https://github.com/Wixel/GUMP#available-validators}
        filter: trim|sanitize_string # Filter rules {see: https://github.com/Wixel/GUMP#available-filters}
        classes: block pad-16 # Custom CSS classes to add to this field
        value: Chris # A default value
        placeholder: Enter your name # Placeholder text
        description: Something useful # Description to display under the field

        ### Optional HTML Attributes ###
        autocomplete: "true"
        autofocus: "true"
        min: 2
        max: 6
        pattern: /0-9/+
        step: 2
        maxlength: 100
        readonly: "true"
        disabled: "true"

```

#### Textarea field
```yaml

    # Text field
    message: # This is the field key (HTML name attribute)

        ### Required ###
        label: Message # Label
        type: textarea # Input type

        ### Optional ###
        show_label: false # Whether to display the label above the field (defaults to true)
        validate: required # Validation rules {see: https://github.com/Wixel/GUMP#available-validators}
        filter: trim|sanitize_string # Filter rules {see: https://github.com/Wixel/GUMP#available-filters}
        classes: block pad-16 # Custom CSS classes to add to this field
        value: Chris # A default value
        placeholder: Enter your name # Placeholder text
        description: Something useful # Description to display under the field

        ### Optional HTML Attributes ###
        autocomplete: "true"
        autofocus: "true"
        min: 2
        max: 6
        pattern: /0-9/+
        step: 2
        maxlength: 100
        readonly: "true"
        disabled: "true"

```

#### Select field
```yaml

    # Select field
    country: # This is the field key (HTML name attribute)

        ### Required ###
        label: Country # Label
        type: select # Input type
        options: # List of options (key: value)
            uk: United Kingdom
            usa: United States
            can: Canada

        ### Optional ###
        show_label: false # Whether to display the label above the field (defaults to true)
        validate: required # Validation rules {see: https://github.com/Wixel/GUMP#available-validators}
        filter: trim|sanitize_string # Filter rules {see: https://github.com/Wixel/GUMP#available-filters}
        classes: block pad-16 # Custom CSS classes to add to this field
        value: Chris # A default value
        description: Something useful # Description to display under the field

        ### Optional HTML Attributes ###
        readonly: "true"
        disabled: "true"

```

#### Datepicker field
Provides a Datepicker UI for dealing with dates.
```yaml

    # Datepicker field
    date: # This is the field key (HTML name attribute)

        ### Required ###
        label: Date # Label
        type: datepicker # Input type

        ### Optional ###
        show_label: false # Whether to display the label above the field (defaults to true)
        validate: required # Validation rules {see: https://github.com/Wixel/GUMP#available-validators}
        filter: trim|sanitize_string # Filter rules {see: https://github.com/Wixel/GUMP#available-filters}
        classes: block pad-16 # Custom CSS classes to add to this field
        value: Chris # A default value
        placeholder: Enter your name # Placeholder text
        description: Something useful # Description to display under the field

        ### Optional HTML Attributes ###
        autocomplete: "true"
        autofocus: "true"
        min: 2
        max: 6
        pattern: /0-9/+
        step: 2
        maxlength: 100
        readonly: "true"
        disabled: "true"

```

#### Choice field
Provides a button based UI for small groups of choices
```yaml

    # Choice field
    country: # This is the field key (HTML name attribute)

        ### Required ###
        label: Country # Label
        type: select # Input type
        options: # List of options (key: value)
            uk: United Kingdom
            usa: United States
            can: Canada

        ### Optional ###
        show_label: false # Whether to display the label above the field (defaults to true)
        validate: required # Validation rules {see: https://github.com/Wixel/GUMP#available-validators}
        filter: trim|sanitize_string # Filter rules {see: https://github.com/Wixel/GUMP#available-filters}
        classes: block pad-16 # Custom CSS classes to add to this field
        description: Something useful # Description to display under the field

        ### Optional HTML Attributes ###
        disabled: "true"

```

#### Content field
Allows you to include a template partial inside your form.
```yaml

    # Content field
    notice: # This is the field key (HTML name attribute)

        ### Required ###
        label: Country # Label
        type: content # Input type
        partial: my-notice # Partial name (will load partials/my-notice.php) from your _templates folder

        ### Optional ###
        classes: block pad-16 # Custom CSS classes to add to this field

```

#### Group field
Allows you to group multiple fields in to a single row, uses CSS Grid by default but you can role your own styles if you need to.

__Note:__ Grid layouts only support up to 4 fields at the moment.
```yaml

    # Content field
    group: # This is the field key (HTML name attribute)

        ### Required ###
        label: Group of fields # Label
        type: group # Input type
        fields: # A list of field IDs
            name
            date

        ### Optional ###
        show_label: false # Whether to display the label above the field (defaults to true)
        classes: block pad-16 # Custom CSS classes to add to this field
        description: Something useful # Description to display under the field
        grid: false # Display items as block

```

### Validation & Filters

Field validation and filtering is done by GUMP. Form also provides a spam filter validator, which allows you to invalidate a form if you find spam.

See `inc/functions.php` in the Form plugin for more details.

The validator for this is `spam_filter`. Add this to your validation rules to apply the spam checks.

## Render a form!

![Form example](https://assets.resknow.co.uk/images/form-example.png)

Once you've created your form, to render it on your page, include the following where you'd like it to display:

```php
<?php echo render_form( 'my-form' ) ?>
```

Switch out `my-form` for your actual form ID :)

Also note that the example screenshot above includes custom styling, the Form plugin tries not to give you opinionated styles, that's on you as the designer.
