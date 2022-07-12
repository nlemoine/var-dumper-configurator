<?php

namespace HelloNico\VarDumperConfigurator;

class FileLinkFormatter
{
    private const FORMATS = [
        'textmate' => 'txmt://open?url=file://%f&line=%l',
        'macvim' => 'mvim://open?url=file://%f&line=%l',
        'emacs' => 'emacs://open?url=file://%f&line=%l',
        'sublime' => 'subl://open?url=file://%f&line=%l',
        'phpstorm' => 'phpstorm://open?file=%f&line=%l',
        'atom' => 'atom://core/open/file?filename=%f&line=%l',
        'vscode' => 'vscode://file/%f:%l',
    ];

    private ?array $fileLinkFormat = null;

    public function __construct(string $fileLinkFormat = null)
    {
        $fileLinkFormat = (self::FORMATS[$fileLinkFormat] ?? $fileLinkFormat);
        if ($fileLinkFormat && !\is_array($fileLinkFormat)) {
            $i = strpos($f = $fileLinkFormat, '&', max(strrpos($f, '%f'), strrpos($f, '%l'))) ?: \strlen($f);
            $fileLinkFormat = [substr($f, 0, $i)] + preg_split('/&([^>]++)>/', substr($f, $i), -1, \PREG_SPLIT_DELIM_CAPTURE);
        }

        $this->fileLinkFormat = $fileLinkFormat;
    }

    public function format(string $file, int $line)
    {
        if ($fmt = $this->fileLinkFormat) {
            for ($i = 1; isset($fmt[$i]); ++$i) {
                if (str_starts_with($file, $k = $fmt[$i++])) {
                    $file = substr_replace($file, $fmt[$i], 0, \strlen($k));
                    break;
                }
            }

            return strtr($fmt[0], ['%f' => $file, '%l' => $line]);
        }

        return false;
    }
}
