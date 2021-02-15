<!doctype html> 
<html> 
<head> 
    <title>DataTables and Codeigniter</title> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
    <!--data table--> 
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/pdfmake-0.1.18/dt-1.10.12/b-1.2.2/b-colvis-1.2.2/b-html5-1.2.2/b-print-1.2.2/r-2.1.0/datatables.min.css" /> 
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/pdfmake-0.1.18/dt-1.10.12/b-1.2.2/b-colvis-1.2.2/b-html5-1.2.2/b-print-1.2.2/r-2.1.0/datatables.min.js"></script> 
    <!--/.data table--> 
    <style> 
        body { 
            padding: 15px; 
        } 
    </style> 
</head> 
<body> 
    <div class="row" style="margin-bottom: 10px"> 
        <div class="col-md-4"> 
            <h2 style="margin-top:0px">Audit Log List</h2> 
        </div> 
    </div> 
    <table class="table table-bordered table-striped" id="auditlog_table"> 
        <thead> 
            <tr> 
                <th width="80px">SNo</th> 
                <th>User Id</th> 
                <th>Action</th> 
                <th>Module Name</th> 
                <th>Old Values</th> 
                <th>New Values</th> 
                <th>Created at</th> 
            </tr> 
        </thead> 
        <tbody> 
            <?php 
            $start = 0; 
            foreach ($auditlog_data as $auditlog) 
            { 
                // if($auditlog['action'] == "Update"){

                ?> 
                <tr> 
                    <td> 
                        <?php echo ++$start ?> 
                    </td> 
                    <td> 
                        <?php echo $auditlog['user_id'] ?> 
                    </td> 
                    <td> 
                        <?php echo $auditlog['action'] ?> 
                    </td> 
                    <td> 
                        <?php echo $auditlog['module_name'] ?> 
                    </td> 

                    <?php 
                    if($auditlog['action'] == "Update"){
                    ?>

                    <td> 
                        <?php 
                    $old_values = json_decode($auditlog['old_values']);

                    foreach($old_values as $key => $val) {
                        $str = '';

                        if(count($val) > 1){
                            $str.=$key. ' - ';
                        }

                        foreach(((array)$old_values)[$key] as $val1) {
                            if(count($val) > 1){
                              $str.=$val1.', ';
                            }
                            else
                            {
                                echo $key. ' - ' .$val1;
                            }
                        }
                        $str = rtrim($str, ', ');
                        echo $str.'<br/>';

                    }
                         ?> 
                    </td> 
                    <td> 
                       <?php 
                    $new_values = json_decode($auditlog['new_values']);

                    foreach($new_values as $key => $val) {
                        $str = '';

                        if(count($val) > 1){
                            $str.=$key. ' - ';
                        }

                        foreach(((array)$new_values)[$key] as $val1) {
                            if(count($val) > 1){
                              $str.=$val1.', ';
                            }
                            else
                            {
                                echo $key. ' - ' .$val1;
                            }
                        }
                        $str = rtrim($str, ', ');
                        echo $str.'<br/>';

                    }
                         ?> 
                    </td> 
                <?php 
                }
                else if($auditlog['action'] == "Insert"){

                ?>
                <td>
                    <?php echo 'None' ?>
                </td>
                <td> 
                       <?php 
                    $new_values = json_decode($auditlog['new_values']);

                    foreach($new_values as $key => $val) {
                        $str = '';

                        if(count($val) > 1){
                            $str.=$key. ' - ';
                        }

                        foreach(((array)$new_values)[$key] as $val1) {
                            if(count($val) > 1){
                              $str.=$val1.', ';
                            }
                            else
                            {
                                echo $key. ' - ' .$val1;
                            }
                        }
                        $str = rtrim($str, ', ');
                        echo $str.'<br/>';

                    }
                         ?> 
                    </td>

                <?php
                }
                ?>
                    <td> 
                        <?php echo $auditlog['created_at'] ?> 
                    </td> 
                </tr> 
                <?php 
            // } 
        }
            ?> 
        </tbody> 
    </table> 
    <script type="text/javascript"> 
        $(document).ready(function() { 
            $("#auditlog_table").dataTable(); 
        }); 
    </script> 
</body> 
</html>