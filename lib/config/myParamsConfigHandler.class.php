<?php

class myParamsConfigHandler extends sfYamlConfigHandler{
  
  public function execute($configFiles)
  {
    
    $data = self::parseYamls($configFiles);

    $code = array();
    $code[] = '<?php';
    $code[] = '// auto-generated by '.__CLASS__;
    $code[] = '// date: '.date('Y/m/d H:is');
    $code[] = 'class myParamsConfig';
    $code[] = '{';
    
    $code[] = '    public static $fields = '.var_export($data, true).';';
    
    $code[] = '    public static function getFieldsDefaultValue(){';

    $code[] = '      $defaults = array();';
    $code[] = '      foreach(self::$fields as $space => $fields){';
    $code[] = '        $defaults[$space] = array();';
    $code[] = '        foreach($fields as $name => $options){';
    $code[] = '          $defaults[$space][$name] = isset($options[\'default\'])?$options[\'default\']:\'\';';
    $code[] = '        }';
    $code[] = '      }';
    $code[] = '      return $defaults;';
    $code[] = '    }';
    
    
    $code[] = '}';

    return implode(PHP_EOL, $code);
  }
  
}