## Gravity Forms Quiz Results - Knowledge Areas
This plugin adds a new field to quiz form fields that allows you to specify the knowledge area
for a given quiz question.

### Shortcode
This plugin also provides a shortcode to output a donut chart breakdown of the quiz results
categorized by the different knowledge areas present in the quiz questions.

```
[quiz_knowledge_results form_id="1" lead_id="1"]
```

**Shortcode Parameters**
* form_id: The id of the gravity form that contains the quiz questions
* lead_id: The id of the form submission which the donut chart results should be displayed for