<?php $this->load->view('part/head');?>

<body class="theme-dark">
<?php $this->load->view('/part/left_menu'); ?>
<?php $this->load->view('/part/top_menu'); ?>
<section class="page-content">
    <div class="page-content-inner">
        <section class="panel panel-with-borders">
            <div class="panel-heading">
                <div class="heading-buttons pull-right">
                    <a href="<?php echo ci_base_url();?>admin/blocks/add" class="btn btn-success margin-inline">Add New Block</a>
                </div>
                <h3 class="messaging-title"><i class="left-menu-link-icon <?php echo $icon;?>"></i> <?php echo $heading;?></h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <table class="table table-striped table-hover" id="dt_<?php echo $entity;?>" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                           <th>Title</th><th>Author</th><th>Alias</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </section>

    </div> <!-- end .page-content-inner -->
    <?php $this->load->view('part/js'); ?>

    

    <script type="text/javascript">
        var oTable;

        var entity = '<?php echo $entity;?>';

        jQuery(document).ready(function() {

            oTable = jQuery("#dt_"+entity).DataTable({
                "dom": '<"top"fl>rt<"bottom"p><"clear">',
                "processing": true,
                "serverSide": true,
                "ajax": ci_base_url + 'admin/'+ entity +"/pagesdt",
                "columns": [
                    { "data": 'title', render:function(data){
                            if(data){
                                var data_arr = data.split("___");
                                var thtml = '<div class="list-title-wrap" <a class="list_title" href="'+ci_base_url+'admin/pages/edit/'+data_arr[1]+'">'+data_arr[0]+'<a><div class="list-action-wrap"><a href="'+ci_base_url+'admin/blocks/edit/'+data_arr[1]+'">Edit</a> <a href="'+ci_base_url+'admin/blocks/delete/'+data_arr[1]+'">Delete</a> </div></div>';
                                return thtml;
                            } else { return ''; }
                        }
                    },
                    { "data": 'author' },
                    { "data": 'alias' },
                    
                    ///{"data":null,  "orderable": false, "defaultContent":"<button class='btn btn-primary action share_info'><i class='fa fa-info fa-fw'></i></button> &nbsp;&nbsp;"}

                ],

                "order": [[0, 'asc']],
                "initComplete": function(settings, json) {
                    //jQuery.fn.dt_loaded();
                    dt_loaded();
                },
                "fnDrawCallback": function( oSettings ) {
                    //jQuery.fn.dt_loaded();
                }
            });

        });
        function dt_loaded(){
            //jQuery(".share_info").click(function(e){
              //  var id = jQuery(this).parents('tr').attr('id');
                //window.location = ci_base_url+'account/share/'+id;
          //  });
        }
    </script>

    <script src="<?php echo ci_public();?>pvngen.js"></script>
</section>

<div class="main-backdrop"><!-- --></div>

</body>
</html>




