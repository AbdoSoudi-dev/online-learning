<template>
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Invoice Report</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Invoice Report</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="datatable table table-hover table-center mb-0">
                                    <thead>
                                    <tr>
                                        <th>Invoice Number</th>
                                        <th>Mentee ID</th>
                                        <th>Mentee Name</th>
                                        <th>Total Amount</th>
                                        <th>Created Date</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><a>#IN0001</a></td>
                                        <td>#01</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a  class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/user/user.jpg" alt="User Image"></a>
                                                <a >Jonathan Doe </a>
                                            </h2>
                                        </td>
                                        <td>$100.00</td>
                                        <td>9 Sep 2019</td>
                                        <td class="text-center">
                                            <span class="badge badge-pill bg-success inv-badge">Paid</span>
                                        </td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a data-bs-toggle="modal" href="#edit_invoice_report" class="btn btn-sm bg-success-light me-2">
                                                    <i class="fe fe-pencil"></i> Edit
                                                </a>
                                                <a class="btn btn-sm bg-danger-light" data-bs-toggle="modal" href="#delete_modal">
                                                    <i class="fe fe-trash"></i> Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a>#IN0002</a></td>
                                        <td>#02</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a  class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/user/user1.jpg" alt="User Image"></a>
                                                <a >Julie Pennington </a>
                                            </h2>
                                        </td>
                                        <td>$200.00</td>
                                        <td>29 Oct 2019</td>
                                        <td class="text-center">
                                            <span class="badge badge-pill bg-success inv-badge">Paid</span>
                                        </td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a data-bs-toggle="modal" href="#edit_invoice_report" class="btn btn-sm bg-success-light me-2">
                                                    <i class="fe fe-pencil"></i> Edit
                                                </a>
                                                <a class="btn btn-sm bg-danger-light" data-bs-toggle="modal" href="#delete_modal">
                                                    <i class="fe fe-trash"></i> Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a>#IN0003</a></td>
                                        <td>#03</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a  class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/user/user2.jpg" alt="User Image"></a>
                                                <a >Tyrone Roberts</a>
                                            </h2>
                                        </td>
                                        <td>$250.00</td>
                                        <td>25 Sep 2019</td>
                                        <td class="text-center">
                                            <span class="badge badge-pill bg-success inv-badge">Paid</span>
                                        </td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a data-bs-toggle="modal" href="#edit_invoice_report" class="btn btn-sm bg-success-light me-2">
                                                    <i class="fe fe-pencil"></i> Edit
                                                </a>
                                                <a class="btn btn-sm bg-danger-light" data-bs-toggle="modal" href="#delete_modal">
                                                    <i class="fe fe-trash"></i> Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a>#IN0004</a></td>
                                        <td>#04</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a  class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/user/user3.jpg" alt="User Image"></a>
                                                <a >Allen Davis </a>
                                            </h2>
                                        </td>
                                        <td>$150.00</td>
                                        <td>9 Oct 2019</td>
                                        <td class="text-center">
                                            <span class="badge badge-pill bg-success inv-badge">Paid</span>
                                        </td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a data-bs-toggle="modal" href="#edit_invoice_report" class="btn btn-sm bg-success-light me-2">
                                                    <i class="fe fe-pencil"></i> Edit
                                                </a>
                                                <a class="btn btn-sm bg-danger-light" data-bs-toggle="modal" href="#delete_modal">
                                                    <i class="fe fe-trash"></i> Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a>#IN0005</a></td>
                                        <td>#05</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a  class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/user/user4.jpg" alt="User Image"></a>
                                                <a >Patricia Manzi </a>
                                            </h2>
                                        </td>
                                        <td>$350.00</td>
                                        <td>19 Nov 2019</td>
                                        <td class="text-center">
                                            <span class="badge badge-pill bg-success inv-badge">Paid</span>
                                        </td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a data-bs-toggle="modal" href="#edit_invoice_report" class="btn btn-sm bg-success-light me-2">
                                                    <i class="fe fe-pencil"></i> Edit
                                                </a>
                                                <a class="btn btn-sm bg-danger-light" data-bs-toggle="modal" href="#delete_modal">
                                                    <i class="fe fe-trash"></i> Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a>#IN0006</a></td>
                                        <td>#06</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a  class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/user/user5.jpg" alt="User Image"></a>
                                                <a >Elsie Gilley</a>
                                            </h2>
                                        </td>
                                        <td>$300.00</td>
                                        <td>12 Oct 2019</td>
                                        <td class="text-center">
                                            <span class="badge badge-pill bg-success inv-badge">Paid</span>
                                        </td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a data-bs-toggle="modal" href="#edit_invoice_report" class="btn btn-sm bg-success-light me-2">
                                                    <i class="fe fe-pencil"></i> Edit
                                                </a>
                                                <a class="btn btn-sm bg-danger-light" data-bs-toggle="modal" href="#delete_modal">
                                                    <i class="fe fe-trash"></i> Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a>#IN0007</a></td>
                                        <td>#07</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a  class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/user/user11.jpg" alt="User Image"></a>
                                                <a > Joan Gardner</a>
                                            </h2>
                                        </td>
                                        <td>$250.00</td>
                                        <td>25 Oct 2019</td>
                                        <td class="text-center">
                                            <span class="badge badge-pill bg-success inv-badge">Paid</span>
                                        </td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a data-bs-toggle="modal" href="#edit_invoice_report" class="btn btn-sm bg-success-light me-2">
                                                    <i class="fe fe-pencil"></i> Edit
                                                </a>
                                                <a class="btn btn-sm bg-danger-light" data-bs-toggle="modal" href="#delete_modal">
                                                    <i class="fe fe-trash"></i> Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a>#IN0008</a></td>
                                        <td>#08</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/user/user12.jpg" alt="User Image"></a>
                                                <a > Daniel Griffing</a>
                                            </h2>
                                        </td>
                                        <td>$150.00</td>
                                        <td>30 Oct 2019</td>
                                        <td class="text-center">
                                            <span class="badge badge-pill bg-success inv-badge">Paid</span>
                                        </td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a data-bs-toggle="modal" href="#edit_invoice_report" class="btn btn-sm bg-success-light me-2">
                                                    <i class="fe fe-pencil"></i> Edit
                                                </a>
                                                <a class="btn btn-sm bg-danger-light" data-bs-toggle="modal" href="#delete_modal">
                                                    <i class="fe fe-trash"></i> Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a>#IN0009</a></td>
                                        <td>#09</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a  class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/user/user8.jpg" alt="User Image"></a>
                                                <a >Walter Roberson</a>
                                            </h2>
                                        </td>
                                        <td>$100.00</td>
                                        <td>5 Nov 2019</td>
                                        <td class="text-center">
                                            <span class="badge badge-pill bg-success inv-badge">Paid</span>
                                        </td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a data-bs-toggle="modal" href="#edit_invoice_report" class="btn btn-sm bg-success-light me-2">
                                                    <i class="fe fe-pencil"></i> Edit
                                                </a>
                                                <a class="btn btn-sm bg-danger-light" data-bs-toggle="modal" href="#delete_modal">
                                                    <i class="fe fe-trash"></i> Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a>#IN0010</a></td>
                                        <td>#10</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a  class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/user/user9.jpg" alt="User Image"></a>
                                                <a >Robert Rhodes </a>
                                            </h2>
                                        </td>
                                        <td>$120.00</td>
                                        <td>7 Nov 2019</td>
                                        <td class="text-center">
                                            <span class="badge badge-pill bg-success inv-badge">Paid</span>
                                        </td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a data-bs-toggle="modal" href="#edit_invoice_report" class="btn btn-sm bg-success-light me-2">
                                                    <i class="fe fe-pencil"></i> Edit
                                                </a>
                                                <a class="btn btn-sm bg-danger-light" data-bs-toggle="modal" href="#delete_modal">
                                                    <i class="fe fe-trash"></i> Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit_invoice_report" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Invoice Report</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row form-row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Invoice Number</label>
                                    <input type="text" class="form-control" value="#INV-0001">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Mentee ID</label>
                                    <input type="text" class="form-control" value="	#01">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Mentee Name</label>
                                    <input type="text" class="form-control" value="Jonathan Doe">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Mentee Image</label>
                                    <input type="file" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Total Amount</label>
                                    <input type="text" class="form-control" value="$200.00">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Created Date</label>
                                    <input type="text" class="form-control" value="29th Oct 2019">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
    export default {
        name: "invoices"
    }
</script>

<style scoped>

</style>
