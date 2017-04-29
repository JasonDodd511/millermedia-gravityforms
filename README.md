## Gravity Forms Quiz Results - Knowledge Areas
This plugin adds a new field to quiz form fields that allows you to specify the knowledge area
for a given quiz question.

### Knowledge Results Shortcode
This plugin also provides a shortcode to output a donut chart breakdown of the quiz results
categorized by the different knowledge areas present in the quiz questions.

```
[quiz_knowledge_results form_id="1" lead_id="1"]
```

**Shortcode Parameters**
* form_id: The id of the gravity form that contains the quiz questions
* lead_id: The id of the form submission which the donut chart results should be displayed for

### Random Form Shortcode
You can generate a random form based on a taxonomy term classification. To set this up, visit 
the settings page at WP Admin > Gravity Forms Quiz Groups. Select the taxonomy that you want 
to use to classify your forms. Then when you edit a gravity form, you can select its classification
terms from the "Settings" tab in the "Form Settings" section under the heading "Classification".

```
[random_gravityform term=1]
```

**Shortcode Parameters**
* term: The id of a taxonomy term that you want to pull a random form from

*Note:*: You can also pass any other parameters that are accepted by the standard `[gravityform]`
shortcode which will be proxied along to the form when it is generated.