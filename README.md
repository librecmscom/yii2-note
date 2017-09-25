# yii2-note

仿 https://pastebin.com/ 的笔记

[![Latest Stable Version](https://poser.pugx.org/yuncms/yii2-note/v/stable.png)](https://packagist.org/packages/yuncms/yii2-note)
[![Total Downloads](https://poser.pugx.org/yuncms/yii2-note/downloads.png)](https://packagist.org/packages/yuncms/yii2-note)
[![Reference Status](https://www.versioneye.com/php/yuncms:yii2-note/reference_badge.svg)](https://www.versioneye.com/php/yuncms:yii2-note/references)
[![Build Status](https://img.shields.io/travis/yiisoft/yii2-note.svg)](http://travis-ci.org/yuncms/yii2-note)
[![Dependency Status](https://www.versioneye.com/php/yuncms:yii2-note/dev-master/badge.png)](https://www.versioneye.com/php/yuncms:yii2-note/dev-master)
[![License](https://poser.pugx.org/yuncms/yii2-note/license.svg)](https://packagist.org/packages/yuncms/yii2-note)

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```bash
$ composer require yuncms/yii2-note
```

or add

```
"yuncms/yii2-note": "~2.0.0"
```

to the `require` section of your `composer.json` file.

笔记Url规则

```php
    'notes/<page:\d+>' => 'note/note/index',
    'notes/create' => 'note/note/create',
    'notes' => 'note/note/index',
    'notes/<uuid:[\w+]+>/print' => 'note/note/print',
    'notes/<uuid:[\w+]+>/download' => 'note/note/download',
    'note/<uuid:[\w+]+>' => 'note/note/view',

```
    
## License

This is released under the MIT License. See the bundled [LICENSE.md](LICENSE.md)
for details.