<?php

use HelloNico\VarDumperConfigurator\VarDumperConfigurator;

$ide = (getenv('VAR_DUMPER_IDE') ?: null) ?? $_SERVER['VAR_DUMPER_IDE'] ?? null;
$theme = (getenv('VAR_DUMPER_THEME') ?: null) ?? $_SERVER['VAR_DUMPER_THEME'] ?? null;
VarDumperConfigurator::configure($ide, $theme);
