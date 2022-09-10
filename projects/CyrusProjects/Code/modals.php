<!-- modals -->
<div class="modal fade" data-bs-backdrop="static" id="NewOrg" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-corner">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Organization</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-control rounded-corner" id="FAddOrg">
                    <div class="lg-3">
                        <label for="recipient-name" class="col-form-label">Enter Organization Name</label>
                        <input type="text" class="form-control rounded-corner" id="neworg">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary SaveOrg">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" data-bs-backdrop="static" id="NewDivision" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-corner">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Division</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-control rounded-corner" id="FAddDiv">
                    <div class="lg-3">
                        <label for="recipient-name" class="col-form-label">Select Organization</label>
                        <select class="form-select form-control rounded-corner" id="OrgCodeNDiv">
                            <option value="">Select</option>
                            <?php

                            $result=mysqli_query($con,$QueryOrg);
                            if (mysqli_num_rows($result)>0)
                            {
                              while ($arr=mysqli_fetch_assoc($result))
                              {
                                ?>
                                <option value="<?php echo $arr['OrganizationCode']; ?>"><?php echo $arr['Organization']; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="lg-3">
                    <label for="recipient-name" class="col-form-label">Enter Division Name</label>
                    <input type="text" class="form-control rounded-corner" id="newdiv">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary SaveDiv">Save</button>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="NewOrder" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content rounded-corner">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-control rounded-corner" id="FAddOrder">
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="recipient-name" class="col-form-label">Select Organization</label>
                            <select class="form-select form-control rounded-corner" id="OrgCode">
                                <option value="">Select</option>
                                <?php

                                $result=mysqli_query($con,$QueryOrg);
                                if (mysqli_num_rows($result)>0)
                                {
                                  while ($arr=mysqli_fetch_assoc($result))
                                  {
                                    ?>
                                    <option value="<?php echo $arr['OrganizationCode']; ?>"><?php echo $arr['Organization']; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label for="recipient-name" class="col-form-label">Select Division</label>
                        <select class="form-select form-control rounded-corner" id="DivisionCode">
                            <option value="">Select</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label for="recipient-name" class="col-form-label">LOA Date</label>
                        <input type="date" class="form-control rounded-corner" id="LOADate">
                    </div>
                    <div class="col-lg-3">
                        <label for="recipient-name" class="col-form-label">Completion Date</label>
                        <input type="date" class="form-control rounded-corner" id="Completion">
                    </div>
                    <div class="col-lg-3">
                        <label for="recipient-name" class="col-form-label">BG Amount</label>
                        <input type="number" min="0" class="form-control rounded-corner" id="BGAmount">
                    </div>
                    <div class="col-lg-3">
                        <label for="recipient-name" class="col-form-label">BG Date</label>
                        <input type="date" class="form-control rounded-corner" id="BGDate">
                    </div>

                    <div class="col-lg-3">
                        <label for="recipient-name" class="col-form-label">Warranty in months</label>
                        <input type="number" min="0" class="form-control rounded-corner" id="Warranty">
                    </div>
                    <div class="col-lg-3">
                        <label for="recipient-name" class="col-form-label">Odering Authority</label>
                        <input type="text" maxlength="150" class="form-control rounded-corner" id="OderingAuth">
                    </div>
                    <div class="col-lg-3">
                        <label for="recipient-name" class="col-form-label">Billing Authority</label>
                        <input type="text" maxlength="150" class="form-control rounded-corner" id="BillingAuth">
                    </div>

                    <div class="col-lg-3">
                        <label for="recipient-name" class="col-form-label">LOA Number</label>
                        <input type="text" maxlength="200" class="form-control rounded-corner" id="LOANumber">
                    </div>
                    <div class="col-lg-6">
                        <label for="recipient-name" class="col-form-label">Description</label>
                        <textarea class="form-control rounded-corner" type="text" maxlength="750" id="Description"></textarea>
                    </div>
                    <center>
                        <div class="col-lg-4">
                            <label for="recipient-name" class="col-form-label">Upload LOA </label>
                            <i class="ri-file-upload-fill"></i>
                            <input type="file" class="form-control rounded-corner" id="LOAFile">
                        </div>
                    </center>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary SaveOrder">Save</button>
        </div>
    </div>
</div>
</div>


<div class="modal fade" id="NewSite" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content rounded-corner">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Site</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-control rounded-corner">
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="recipient-name" class="col-form-label">Select Organization</label>
                            
                            <select class="form-control rounded-corner select2" id="OrgCodeSite">
                                <option value="">Select</option>
                                <?php

                                $result=mysqli_query($con,$QueryOrg);
                                if (mysqli_num_rows($result)>0)
                                {
                                  while ($arr=mysqli_fetch_assoc($result))
                                  {
                                    ?>
                                    <option value="<?php echo $arr['OrganizationCode']; ?>"><?php echo $arr['Organization']; ?></option>
                                    <?php
                                }}?>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label for="recipient-name" class="col-form-label">Select Division</label>
                            <select class="form-select form-control rounded-corner" id="DivisionCodeSite">
                                <option value="">Select</option>

                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label for="recipient-name" class="col-form-label">Site Name</label>
                            <input type="date" class="form-control rounded-corner" id="SiteName">
                        </div>
                        <div class="col-lg-6">
                            <label for="recipient-name" class="col-form-label">Address</label>
                            <textarea class="form-control rounded-corner" type="text" maxlength="180" id="SiteAddress"></textarea>
                        </div>
                        <div class="col-lg-4" style="margin-top: 10px;">
                            <label for="recipient-name" class="col-form-label">Consignee</label>
                            <input type="text" maxlength="130" class="form-control rounded-corner" id="Consignee">
                        </div>

                        <div class="col-lg-2" style="margin-top: 50px;">
                            <button class="bt btn-lg btn-primary AddSite">Add</button>
                        </div>

                    </div>
                </form>

                <table class="table table-centered table-hover table-bordered border-primary rounded-corner" style="margin-top:25px">
                    <thead>
                        <th>Site Name</th>
                        <th>Address</th>
                        <th>Consignee</th>
                        <th>Action</th>
                    </thead>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary SaveSite">Save</button>
            </div>
        </div>
    </div>
</div>

