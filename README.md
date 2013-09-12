carew-plugin-fastnav
====================

### FastNav plugin

#### Summary

My second plugin for [carew](http://carew.github.io) is a « Fast Navigation » plugin.

This simple plugin help you create links to the previous and the next blog post of the current post.

You can see it in action at the bottom of each blog post on my [blog](https://bacardi55.org)


#### How to install it

A package is available on packagist in order to make it very simple for you to install.

All you have to do is to edit your `composer.json` file to add this requirement:

    "bacardi55/carew-plugin-fastnav": "1.*dev"

Then, `php composer.php update` or `php composer.php install` depending on your case.


#### How to use it

Edit the carew config.yml file to enable the extension:

    engine:
        …
        extensions:
            …
            - Carew\Plugin\FastNav\FastNavExtension
            …

Then, in your twig blog post template file, you can use the following variables:

- The previous post link: `document.metadatas.fastNav.prev.link`
- The previous post title: `document.metadatas.fastNav.prev.title`
- The next post link: `document.metadatas.fastNav.next.link`
- The next post title: `document.metadatas.fastNav.next.title`


Here is a full example of how this plugin is used on my blog:

    twig
    {% if document.metadatas.fastNav is not null %}
      <div class="fastNav">
        {% if document.metadatas.fastNav.prev.link %}
          <div class="prev pull-left">
            <a href="{{ document.metadatas.fastNav.prev.link }}">
              ← {{ document.metadatas.fastNav.prev.title }}
            </a>
          </div>
        {% endif %}
        {% if document.metadatas.fastNav.next.link %}
          <div class="next pull-right">
            <a href="{{ document.metadatas.fastNav.next.link }}">
              {{ document.metadatas.fastNav.next.title }} →
            </a>
          </div>
        {% endif %}
      </div>
    {% endif %}


#### Source code

You can find the code on github [here](https://github.com/bacardi55/carew-plugin-fastnav)

The package can be found [here](https://packagist.org/packages/bacardi55/carew-plugin-fastnav) on packagist.
