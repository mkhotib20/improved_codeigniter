<?php

class Dev extends Controller {

	public function index()
	{
        if ($this->input->post('class')!=null) {
            $table = $this->input->post('class');
            if ($this->db->table_exists($table)) {
                $fields_meta = $this->db->field_data($table);
                $index=0;
                foreach ($fields_meta as $key => $value) {
                    if (!$value->primary_key) {
                        $fields[$index]['field'] = $value->name;
                        $fields[$index]['type'] = $value->type == 'int' ? 'int' : 'string' ;
                        $index++;
                    }
                    else{
                        $pk = $value->name;
                    }
                }
                // dd($fields);

                $class = str_replace('_', ' ', $table);
                $class = ucwords($class);
                $class = str_replace(' ', '', $class);
                $controllerName = $class.'Controller';
                $this->createController($controllerName, $class);
                $this->createModel($class, $table, $fields, $pk);
                $this->updateRouter($table,$controllerName);
                echo "<script>alert('model & controller created')</script>";
            }
            else{
                echo 'table not exists';
            }
        }
        $this->render('newController');
        
    }
    public function updateRouter($table, $controller)
    {
        $table = str_replace('_', '-', $table);
        $old = file_get_contents ('./application/config/routes.php');
        $myfile = fopen('application/config/routes.php', "w") or die("Unable to open file!");
        fwrite($myfile, $old);
        $txt = "\n\$route['".$table."'] = '".$controller."';";
        fwrite($myfile, $txt);
        fclose($myfile);
        
    }
    public function createController($class, $model)
    {
        $myfile = fopen('application/controllers/'.$class.".php", "w") or die("Unable to open file!");
        $txt = "<?php \n";
        fwrite($myfile, $txt);
        $txt = 'class '.$class." extends Controller \n{\n\tpublic \$models = ['".$model."']; \n\tpublic function index()\n";
        fwrite($myfile, $txt);
        $txt = "\t{\n\t\techo 'hello $class';\n";
        fwrite($myfile, $txt);
        $txt = "\t}\n";
        fwrite($myfile, $txt);
        $txt = "} ";
        fwrite($myfile, $txt);
        fclose($myfile);
    }
    public function createModel($class, $table, $fields, $pk)
    {
        $str_fields = implode(",\n", array_map(function ($entry) {
            return "\t\t['field' => '".$entry['field']."'".",'type' => '".$entry['type']."']";
          }, $fields));
        $myfile = fopen('application/models/'.$class.".php", "w") or die("Unable to open file!");
        $txt = "<?php \n";
        fwrite($myfile, $txt);
        $txt = 'class '.$class." extends Models \n{\n\tpublic \$tablname = '$table';";
        fwrite($myfile, $txt);
        $txt = "\n\tpublic \$columns = [\n".$str_fields."\n\t];";
        fwrite($myfile, $txt);
        $txt = "\n\tpublic \$primaryKey = '$pk'; \n";
        fwrite($myfile, $txt);
        $txt = "} ";
        fwrite($myfile, $txt);
        fclose($myfile);
    }
    
}
?>