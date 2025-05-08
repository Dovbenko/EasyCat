# BySudo_EasyCat

This is an example module developed for Magento 2. It demonstrates how to create a custom module that displays a product list and a custom form on the homepage and checkout page.

While this module is currently intended as an example, it may be extended in the future to provide more advanced catalog features or production-ready functionality.

## Features
- Displays a list of products on the homepage and checkout page
- Includes a custom form on the checkout page
- Uses modern PHP features (strict types, constructor property promotion)

## Installation
Place the module in `app/code/BySudo/EasyCat` and enable it with:

```
bin/magento module:enable BySudo_EasyCat
bin/magento setup:upgrade
bin/magento cache:clean
bin/magento setup:static-content:deploy -f
```

## License
MIT or as specified by the project owner. 