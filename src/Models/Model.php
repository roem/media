<?php

namespace Roem\Media\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Roedel\Model\Revisionable;

class Model extends Eloquent {
    use Revisionable;
}
