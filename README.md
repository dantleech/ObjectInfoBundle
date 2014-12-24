# Symfony CMF ObjectInfo Bundle

[![Build Status](https://secure.travis-ci.org/symfony-cmf/ObjectInfoBundle.png?branch=master)](http://travis-ci.org/symfony-cmf/ObjectInfoBundle)
[![Latest Stable Version](https://poser.pugx.org/symfony-cmf/object-info-bundle/version.png)](https://packagist.org/packages/symfony-cmf/object-info-bundle)
[![Total Downloads](https://poser.pugx.org/symfony-cmf/object-info-bundle/d/total.png)](https://packagist.org/packages/symfony-cmf/object-info-bundle)

This bundle is part of the [Symfony Content Management Framework (CMF)](http://cmf.symfony.com/)
and licensed under the [MIT License](LICENSE).

This bundle allows you to access inferred information from objects, for
example:

````php
$object = new Product();
// ...

$objectInfoManager->provideInfo($object);

echo $info['route']['edit']; // http://path/to/edit?id=123
echo $info['title']; // "My product title"
echo $info['icon']; // /path/to/icon.png
````

## Requirements 

* Symfony 2.2.x
* See also the `require` section of [composer.json](composer.json)

## Documentation

Not yet.

* [All Symfony CMF documentation](http://symfony.com/doc/master/cmf/index.html) - complete Symfony CMF reference
* [Symfony CMF Website](http://cmf.symfony.com/) - introduction, live demo, support and community links

## Contributing

Pull requests are welcome. Please see our
[CONTRIBUTING](https://github.com/symfony-cmf/symfony-cmf/blob/master/CONTRIBUTING.md)
guide.

Unit and/or functional tests exist for this bundle. See the
[Testing documentation](http://symfony.com/doc/master/cmf/components/testing.html)
for a guide to running the tests.

Thanks to
[everyone who has contributed](https://github.com/symfony-cmf/ObjectInfoBundle/contributors) already.
## Running the tests
