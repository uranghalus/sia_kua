 <div class="row">
     <div class="col-md-12">
         <div class="box box-success">
             <div class="box-header with-border">
                 <div class="col-xs-11">
                     <h3 class="box-title">Rekap Laporan Penghulu</h3>
                 </div>
                 <div class="col-xs-1">
                     <a href="scripts/lap-penghulu" class="btn btn-default"><i class="fa fa-print"></i> Cetak</a>
                 </div>
             </div>
             <div class="box-body">
                 <div class="row">
                     <div class="col-md-12">
                         <table id="example1" class="table table-bordered table-striped">
                             <thead>
                                 <tr>
                                     <th><b>No.</b></th>
                                     <th><b>NIP</b></th>
                                     <th><b>Nama Penghulu</b></th>
                                     <th><b>Foto</b></th>
                                     <th><b>Alamat</b></th>
                                     <th><b>Telpon</b></th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php $no = 1;
                                    $sql = "SELECT * FROM tbl_penghulu";
                                    $query = mysqli_query($connectdb, $sql);
                                    ?>
                                 <?php if ($query) : ?>
                                     <?php while ($data = $query->fetch_assoc()) : ?>
                                         <tr>
                                             <td><?php echo $no; ?></td>
                                             <td><?php echo $data['Nip'] ?></td>
                                             <td><?php echo $data['nama_penghulu'] ?></td>
                                             <td><img src="../library/xcrud/uploads/<?php echo $data['foto'] ?>" alt="<?php echo $data['nama_penghulu'] ?>" width="120px"></td>
                                             <td><?php echo $data['alamat_penghulu'] ?></td>
                                             <td><?php echo $data['telpon_penghulu'] ?></td>
                                         </tr>
                                     <?php $no++;
                                        endwhile ?>
                                 <?php else : $msg = mysqli_error_list($connectdb);
                                        echo json_encode($msg); ?>
                                 <?php endif ?>
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
             <!-- /.box-body -->
         </div>
     </div>
 </div>