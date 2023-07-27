# Contao News - Like Button

Integrate your own like button into your contao news.

## Installation

### Install using Contao Manager

Search for **news like** and you will find this extension.

### Install using Composer

## System requirements

- PHP: `^8.1`
- Contao: `^4.13 || ^5.1` 
- Contao News Bundle: `^4.13 || ^5.1`

## Usage

You can either use our news templates or integrate the like button into your own templates.

### Use our news templates

In the Newslist and/or Newsreader module, you can choose our templates `news_latest_with_likes` or `news_full_with_likes` as news template.

### Integrate the like button into your own templates

To integrate the like button into your own templates, simply include our `_plenta_likes.html.twig` Twig template where ever you want to display the button.

In PHP templates:

```php
<?php $this->insert('_plenta_likes', ['news' => $this->arrData]) ?>
```

In Twig templates:

```
{% include('@Contao/_plenta_likes.html.twig' with {news: _context}) %}
```

The `news` variable expects the news item as an array.