<form action="" method="post">
                              <div data-repeater-list="group-a">
                                 <div data-repeater-item class="row">
                                          <div  class="mb-4 col-lg-5">
                                             <label class="form-label" for="no_of_users">Title</label>
                                             <input type="text" name="option_title" id="option_title" class="form-control" required/>
                                          </div>
                                          <div  class="mb-6 col-lg-5">
                                             <label class="form-label" for="amount">Value</label>
                                             <input type="text" name="option_value" id="option_value" name="untyped-input" class="form-control" required/>
                                          </div>
                                       <div class="col-lg-2 col-sm-4 align-self-center">
                                             <a data-repeater-delete class="btn btn-danger btn-sm edit"  data-bs-toggle="tooltip" data-bs-placement="top" title="Remove this Row"> <i class="fas fa-trash-alt"></i>
                                             </a>
                                          </div>
                                    </div>
                                 </div>
                              <button data-repeater-create type="button" class="btn btn-success  btn-sm mt-2 mt-sm-0"><i class="fas fa-plus me-2"></i> Add New</button>      
                           </div>
                           </div>
                           <div class="row">
                           <div class="mb-5 col-lg-12">
                              <?php if(!empty($allspecifications)):?>
                              <table class="table table-striped table-bordered dt-responsive nowrap">
                                 <thead>
                                    <tr>
                                     <th>Title</th>
                                     <th>Value</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       foreach($allspecifications as $spec):   
                                    ?>
                                    <tr>
                                       <td><?= $spec->option_title;?></td>
                                       <td><?= $spec->option_value;?></td>
                                    </tr>
                                    <?php 
                                       endforeach;
                                    ?>
                                 </tbody>
                              </table>
                              <?php endif;?>
                           </div>
                           
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
</form>