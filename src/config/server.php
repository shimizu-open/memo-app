<?php

return [

    // このページを返したサーバーの名前。.env の SERVER_LABEL（無ければ、このコンテナのホスト名）
    'label' => env('SERVER_LABEL', gethostname()),

];