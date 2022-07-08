@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">System Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped aiz-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th data-breakpoints="lg">Current Version</th>
                            <th data-breakpoints="lg">Required Version</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Php versions</td>
                            <td>7.4.26</td>
                            <td>7.3 or 7.4</td>
                            <td><i class="las la-check text-success"></i></td>
                        </tr>
                        <tr>
                            <td>MySQL</td>
                            <td>10.1.48-MariaDB</td>
                            <td>5.6+</td>
                            <td><i class="las la-check text-success"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">System Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped aiz-table">
                   <thead>
                      <tr>
                         <th>Config Name</th>
                         <th data-breakpoints="lg">Current</th>
                         <th data-breakpoints="lg">Recommended</th>
                         <th>Status</th>
                      </tr>
                   </thead>
                   <tbody>
                      <tr>
                         <td>file_uploads</td>
                         <td>
                            On
                         </td>
                         <td>On</td>
                         <td>
                            <i class="las la-check text-success"></i>
                         </td>
                      </tr>
                      <tr>
                         <td>max_file_uploads</td>
                         <td>
                            20
                         </td>
                         <td>20+</td>
                         <td>
                            <i class="las la-check text-success"></i>
                         </td>
                      </tr>
                      <tr>
                         <td>upload_max_filesize</td>
                         <td>
                            128M
                         </td>
                         <td>128M+</td>
                         <td>
                            <i class="las la-check text-success"></i>
                         </td>
                      </tr>
                      <tr>
                         <td>post_max_size</td>
                         <td>
                            128M
                         </td>
                         <td>128M+</td>
                         <td>
                            <i class="las la-check text-success"></i>
                         </td>
                      </tr>
                      <tr>
                         <td>allow_url_fopen</td>
                         <td>
                            On
                         </td>
                         <td>On</td>
                         <td>
                            <i class="las la-check text-success"></i>
                         </td>
                      </tr>
                      <tr>
                         <td>max_execution_time</td>
                         <td>
                            600
                         </td>
                         <td>600+</td>
                         <td>
                            <i class="las la-check text-success"></i>
                         </td>
                      </tr>
                      <tr>
                         <td>max_input_time</td>
                         <td>
                            120
                         </td>
                         <td>120+</td>
                         <td>
                            <i class="las la-check text-success"></i>
                         </td>
                      </tr>
                      <tr>
                         <td>max_input_vars</td>
                         <td>
                            1000
                         </td>
                         <td>1000+</td>
                         <td>
                            <i class="las la-check text-success"></i>
                         </td>
                      </tr>
                      <tr>
                         <td>memory_limit</td>
                         <td>
                            256M
                         </td>
                         <td>256M+</td>
                         <td>
                            <i class="las la-check text-success"></i>
                         </td>
                      </tr>
                   </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">Extensions information</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                   <thead>
                      <tr>
                         <th>Extension Name</th>
                         <th>Status</th>
                      </tr>
                   </thead>
                   <tbody>
                      <tr>
                         <td>bcmath</td>
                         <td>
                            <i class="las la-check text-success"></i>
                         </td>
                      </tr>
                      <tr>
                         <td>ctype</td>
                         <td>
                            <i class="las la-check text-success"></i>
                         </td>
                      </tr>
                      <tr>
                         <td>json</td>
                         <td>
                            <i class="las la-check text-success"></i>
                         </td>
                      </tr>
                      <tr>
                         <td>mbstring</td>
                         <td>
                            <i class="las la-check text-success"></i>
                         </td>
                      </tr>
                      <tr>
                         <td>zip</td>
                         <td>
                            <i class="las la-check text-success"></i>
                         </td>
                      </tr>
                      <tr>
                         <td>zlib</td>
                         <td>
                            <i class="las la-check text-success"></i>
                         </td>
                      </tr>
                      <tr>
                         <td>openssl</td>
                         <td>
                            <i class="las la-check text-success"></i>
                         </td>
                      </tr>
                      <tr>
                         <td>tokenizer</td>
                         <td>
                            <i class="las la-check text-success"></i>
                         </td>
                      </tr>
                      <tr>
                         <td>xml</td>
                         <td>
                            <i class="las la-check text-success"></i>
                         </td>
                      </tr>
                      <tr>
                         <td>dom</td>
                         <td>
                            <i class="las la-check text-success"></i>
                         </td>
                      </tr>
                      <tr>
                         <td>curl</td>
                         <td>
                            <i class="las la-check text-success"></i>
                         </td>
                      </tr>
                      <tr>
                         <td>fileinfo</td>
                         <td>
                            <i class="las la-check text-success"></i>
                         </td>
                      </tr>
                      <tr>
                         <td>gd</td>
                         <td>
                            <i class="las la-check text-success"></i>
                         </td>
                      </tr>
                      <tr>
                         <td>pdo_mysql</td>
                         <td>
                            <i class="las la-check text-success"></i>
                         </td>
                      </tr>
                   </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">System Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                   <thead>
                      <tr>
                         <th>File or Folder</th>
                         <th>Status</th>
                      </tr>
                   </thead>
                   <tbody>
                      <tr>
                         <td>.env</td>
                         <td>
                            <i class="las la-check text-success"></i>
                         </td>
                      </tr>
                      <tr>
                         <td>public</td>
                         <td>
                            <i class="las la-check text-success"></i>
                         </td>
                      </tr>
                      <tr>
                         <td>app/Providers</td>
                         <td>
                            <i class="las la-check text-success"></i>
                         </td>
                      </tr>
                      <tr>
                         <td>app/Http/Controllers</td>
                         <td>
                            <i class="las la-check text-success"></i>
                         </td>
                      </tr>
                      <tr>
                         <td>storage</td>
                         <td>
                            <i class="las la-check text-success"></i>
                         </td>
                      </tr>
                      <tr>
                         <td>resources/views</td>
                         <td>
                            <i class="las la-check text-success"></i>
                         </td>
                      </tr>
                   </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
