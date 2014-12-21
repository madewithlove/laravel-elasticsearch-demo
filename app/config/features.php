<?php

/* feature toggles */
return [
    'elasticsearch' => (bool) getenv("FEATURES.ELASTICSEARCH")
];