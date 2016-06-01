<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">

        <div class="container-fluid">

            <div class="pull-right">
                <button type="submit" form="form-everypay" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>

            <h1><?php echo $heading_title . " " . $version ?></h1>

            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>

        </div>

    </div>

    <div class="container-fluid">
        <?php if ($error_warning) { ?>

            <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>

        <?php } ?>

        <div class="panel panel-default">

            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
            </div>

            <div class="panel-body">

                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-everypay" class="form-horizontal">

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                        <div class="col-sm-10">
                            <select name="everypay_status" id="input-status" class="form-control">
                                <?php if ($everypay_status) { ?>
                                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                    <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                    <option value="1"><?php echo $text_enabled; ?></option>
                                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                <!-- title languages -->
                <?php foreach ($everypay_title['languages'] as $language) :?>
                    <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-title">
                                <?php echo htmlspecialchars($everypay_title['label']); ?> 
                                <?php if(isset($language['image'])){ ?>
                                    <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" />
                                <?php }elseif(isset($language['name'])){ ?>
                                        <?php echo "(" . $language['name'] . ")"; ?> 
                                <?php  }  ?>
                            </label>
                            <div class="col-sm-10">
                                <input type="text" name="<?php echo htmlspecialchars($everypay_title['name'] . '_' . $language['language_id']); ?>" value="<?php echo htmlspecialchars($everypay_title['value'][$everypay_title['name'] . '_' . $language['language_id']]); ?>" placeholder="<?php echo htmlspecialchars($everypay_title['label']); ?>" id="input-title" class="form-control" />
                            </div>
                        </div>

                <?php endforeach; ?>



                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-login"><?php echo $entry_api_username; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="everypay_api_username" value="<?php echo $everypay_api_username; ?>" placeholder="<?php echo $entry_api_username; ?>" id="input-login" class="form-control" required/>
                            <?php if ($error_api_username) { ?>
                                <div class="text-danger"><?php echo $error_api_username; ?></div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-key"><?php echo $entry_api_secret; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="everypay_api_secret" value="<?php echo $everypay_api_secret; ?>" placeholder="<?php echo $entry_api_secret; ?>" id="input-key" class="form-control" required />
                            <?php if ($error_api_secret) { ?>
                                <div class="text-danger"><?php echo $error_api_secret; ?></div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-key"><span data-toggle="tooltip" title="<?php echo $help_processing_account; ?>"><?php echo $entry_account_id; ?></span></label>
                        <div class="col-sm-10">
                            <input type="text" name="everypay_account_id" value="<?php echo $everypay_account_id; ?>" placeholder="<?php echo $entry_account_id; ?>" id="input-key" class="form-control" required />
                            <?php if ($error_account_id) { ?>
                                <div class="text-danger"><?php echo $error_account_id; ?></div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-server"><span data-toggle="tooltip" title="<?php echo $help_mode; ?>"><?php echo $entry_mode; ?></span></label>
                        <div class="col-sm-10">
                            <select name="everypay_mode" id="input-server" class="form-control">
                                <?php if ($everypay_mode == 'test') { ?>
                                    <option value="test" selected="selected"><?php echo $text_test; ?></option>
                                <?php } else { ?>
                                    <option value="test"><?php echo $text_test; ?></option>
                                <?php } ?>
                                <?php if ($everypay_mode == 'live') { ?>
                                    <option value="live" selected="selected"><?php echo $text_live; ?></option>
                                <?php } else { ?>
                                    <option value="live"><?php echo $text_live; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-login"><?php echo $entry_test_api_username; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="everypay_test_api_username" value="<?php echo $everypay_test_api_username; ?>" placeholder="<?php echo $entry_test_api_username; ?>" id="input-login" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-key"><?php echo $entry_test_api_secret; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="everypay_test_api_secret" value="<?php echo $everypay_test_api_secret; ?>" placeholder="<?php echo $entry_test_api_secret; ?>" id="input-key" class="form-control" />
                            <input type="hidden" name="everypay_transaction_type" value="charge" />
                        </div>
                    </div>

                    <!--                    <div class="form-group">-->
                    <!--                        <label class="col-sm-2 control-label" for="input-method">--><?php //echo $entry_transaction_type; ?><!--</label>-->
                    <!--                        <div class="col-sm-10">-->
                    <!--                            <select name="everypay_transaction_type" id="input-method" class="form-control">-->
                    <!--                                --><?php //if ($everypay_transaction_type == 'authorization') { ?>
                    <!--                                <option value="authorization" selected="selected">--><?php //echo $text_authorization; ?><!--</option>-->
                    <!--                                --><?php //} else { ?>
                    <!--                                <option value="authorisation">--><?php //echo $text_authorization; ?><!--</option>-->
                    <!--                                --><?php //} ?>
                    <!--                                --><?php //if ($everypay_transaction_type == 'charge') { ?>
                    <!--                                <option value="charge" selected="selected">--><?php //echo $text_capture; ?><!--</option>-->
                    <!--                                --><?php //} else { ?>
                    <!--                                <option value="charge">--><?php //echo $text_capture; ?><!--</option>-->
                    <!--                                --><?php //} ?>
                    <!--                            </select>-->
                    <!--                        </div>-->
                    <!--                    </div>-->

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-total"><span data-toggle="tooltip" title="<?php echo $help_total; ?>"><?php echo $entry_total; ?></span></label>
                        <div class="col-sm-10">
                            <input type="text" name="everypay_total" value="<?php echo $everypay_total; ?>" placeholder="<?php echo $entry_total; ?>" id="input-total" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-order-status"><span data-toggle="tooltip" title="<?php echo $help_order_status; ?>"><?php echo $entry_order_status; ?></span></label>
                        <div class="col-sm-10">
                            <select name="everypay_order_status_id" id="input-order-status" class="form-control">
                                <?php foreach ($order_statuses as $order_status) { ?>
                                    <?php if ($order_status['order_status_id'] == $everypay_order_status_id) { ?>
                                        <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-geo-zone"><?php echo $entry_geo_zone; ?></label>
                        <div class="col-sm-10">
                            <select name="everypay_geo_zone_id" id="input-geo-zone" class="form-control">
                                <option value="0"><?php echo $text_all_zones; ?></option>
                                <?php foreach ($geo_zones as $geo_zone) { ?>
                                    <?php if ($geo_zone['geo_zone_id'] == $everypay_geo_zone_id) { ?>
                                        <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-sort-order"><span data-toggle="tooltip" title="<?php echo $help_sort_order; ?>"><?php echo $entry_sort_order; ?></span></label>
                        <div class="col-sm-10">
                            <input type="text" name="everypay_sort_order" value="<?php echo $everypay_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?> 