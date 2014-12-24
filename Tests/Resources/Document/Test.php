<?php

namespace Resources\Document;

/**
 * @PHPCRODM\Document
 *
 * @Meta\Expr("label", "object.getTitle())
 * @Meta\Expr("icon", "'foobar.png')
 * @Meta\Collection("routes", [
 *     @Meta\Expr("view", "['foo_view', {'id': object.getId()}]"),
 *     @Meta\Expr("edit", "['foo_edit', {'id': object.getId()}]"),
 *     @Meta\Expr("delete", "['foo_delete', {'id': object.getId()}]"),
 * ])
 */
class Test
{
}
