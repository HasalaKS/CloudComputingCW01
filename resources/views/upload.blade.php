<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="container my-5">
    <!-- Header Section -->
     
    <div class="text-center mb-4">
    <h1 style="font-size: 60px; font-weight: bold; color: #d63384;">Online Fashion Store</h1>
        <h3 class="text-muted">Elevate Your Life Style</h3>
    </div>

    <!-- Upload Form -->
    <!-- <div class="card shadow-sm border mb-5" style="border-color: #ddd;">
        <div class="card-body p-4" style="background-color: #e0e0e0;">
            <h4 class="card-title mb-4 text-dark" style="font-family: 'Roboto', sans-serif;">
                <i class="fa-solid fa-cloud-upload-alt me-2"></i>Upload a File
            </h4>
            <form action="{{ url('/store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="mb-3">
                    <label for="file" class="form-label fw-semibold text-dark">Select File</label>
                    <input type="file" class="form-control" id="file" name="file">
                </div>
                <button type="submit" class="btn w-100" style="background-color: #2e8b57; color: white;">
                    <i class="fa-solid fa-upload me-2"></i>Upload
                </button>
            </form>
        </div>
    </div> -->

    <!-- Button to Trigger Modal -->
<div class="text-center my-3">
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#uploadModal">
        <i class="fa-solid fa-plus me-2"></i>Add New Items
    </button>
    <!-- Generate Report Modal -->
     <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#generateReportModal">
        <i class="fa-solid fa-file-csv me-2"></i>Generate Report
    </button>
<div class="modal fade" id="generateReportModal" tabindex="-1" aria-labelledby="generateReportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="generateReportModalLabel">Generate Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form action="{{ url('/report/download') }}" method="GET">
                    <!-- CSRF Token -->
                    {{ csrf_field() }}

                    <!-- Date Range Selection in One Row -->
                    <div class="row g-2">
                        <div class="col-md-6">
                            <label for="start_date" class="form-label fw-semibold text-dark">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <div class="col-md-6">
                            <label for="end_date" class="form-label fw-semibold text-dark">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>
                    </div>

                    <!-- Generate Button -->
                    <div class="mt-3">
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fa-solid fa-download me-2"></i>Generate CSV
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@if (session('info'))
<br>
<br>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

</div>

<!-- Modal for Upload Form -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="uploadModalLabel">
                    <i class="fa-solid fa-cloud-upload-alt me-2"></i>Upload a File
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted">Select a file to upload. It will be stored in your S3 bucket.</p>
                <form action="{{ url('/store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    
                    <!-- File Upload Input -->
                    <div class="mb-3">
                        <label for="file" class="form-label fw-semibold text-dark">Select File</label>
                        <input type="file" class="form-control" id="file" name="file">
                    </div>

                    <!-- Input Field 1 -->
                    <div class="mb-3">
                        <label for="input1" class="form-label fw-semibold text-dark">Dress Type</label>
                        <input type="text" class="form-control" id="input1" name="type" placeholder="Enter a dress type">
                    </div>

                    <!-- Input Field 2 -->
                    <div class="mb-3">
                        <label for="input2" class="form-label fw-semibold text-dark">Price (LKR)</label>
                        <input type="text" class="form-control" id="input2" name="price" placeholder="Enter the Price">
                    </div>

                    <!-- Input Field 3 -->
                    <div class="mb-3">
                        <label for="input3" class="form-label fw-semibold text-dark">Available Sizes</label>
                        <input type="text" class="form-control" id="input3" name="size" placeholder="Enter available sizes">
                    </div>

                    <!-- Input Field 3 -->
                    <div class="mb-3">
                        <label for="input3" class="form-label fw-semibold text-dark">Material</label>
                        <input type="text" class="form-control" id="input3" name="material" placeholder="Enter material">
                    </div>

                    <!-- Input Field 3 -->
                    <div class="mb-3">
                        <label for="input3" class="form-label fw-semibold text-dark">Quantity</label>
                        <input type="text" class="form-control" id="input3" name="quantity" placeholder="Enter quantity">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn w-100" style="background-color: #2e8b57; color: white;">
                        <i class="fa-solid fa-upload me-2"></i>Upload
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>



    <!-- File Cards with Static Preview Image -->
    <div>
    <h4 class="text-dark mb-4">New Arrivals</h4>
    @if (count($files) > 0)
        <div class="row g-3">
            @foreach ($files as $file)
                <div class="col-md-3">
                <div class="card border shadow-sm h-100">
    <div class="card-body d-flex flex-column p-3">
        <!-- Static Image Preview -->
        <div class="mb-3 text-center image-container">
            <img src="{{ $file['url'] }}{{ $file['name'] }}" 
                 alt="{{ $file['name'] }}" 
                 class="img-fluid rounded image-hover" 
                 style="max-height: 170px;">
        </div>

        <!-- File Details -->
        <h5 class="card-title text-dark" 
            style="font-family: 'Arial', sans-serif; text-align: center; font-weight: bold;">
            {{ $file['type'] }}
        </h5>
        <br>
        <h6 class="card-title text-dark" style="font-family: 'Arial', sans-serif; text-align: left;">
            {{ 'Price : ' }} {{ $file['price'] }}
        </h6>
        <h6 class="card-title text-dark" style="font-family: 'Arial', sans-serif; text-align: left;">
            {{ 'Material : ' }} {{ $file['material'] }}
        </h6>
        <h6 class="card-title text-dark" style="font-family: 'Arial', sans-serif; text-align: left;">
            {{ 'Quantity : ' }} {{ $file['quantity'] }}
        </h6>

        <!-- Action Buttons at Bottom -->
        <div class="mt-auto d-flex justify-content-start gap-2">
            <a href="{{ url($file['downloadUrl']) }}" class="btn btn-outline-primary btn-sm">
                <i class="fa-solid fa-download"></i> Download
            </a>
            <form action="{{ url($file['removeUrl']) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-outline-danger btn-sm">
                    <i class="fa-solid fa-trash"></i> Delete
                </button>
            </form>
        </div>
    </div>
</div>

                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-muted">No files uploaded yet.</p>
    @endif
</div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


<style>
    /* Card Hover Effect */
    /* .card:hover {
        transform: scale(1.03);
        transition: all 0.3s ease-in-out;
    } */

    /* Fixed size for card images with full image display */
    .img-fluid {
        width: 100%;
        height: 200px;
        object-fit: contain;
        background-color:rgb(255, 255, 255);
    }

    /* Add fixed size to cards */
    .card.border.shadow-sm {
        width: 300px; /* Fixed width for the card */
        height: 450px; /* Fixed height for the card */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        overflow: hidden;
    }

    /* Reduce button width and align them to the left */
    .btn {
        width: auto;
        height: 38px;
    }

    .d-flex {
        display: flex;
        justify-content: flex-start;
    }

    .gap-2 {
        gap: 10px;
    }

    /* Custom font for file name */
    .card-title {
        font-family: 'Arial', sans-serif;
        /* font-size: 16px; */
    }

    /* Card Hover Effect */
    .card:hover {
        transform: scale(1.03);
        transition: all 0.3s ease-in-out;
    }

    /* Image container to handle hover effect */
    .image-container {
        position: relative;
        overflow: hidden;
    }

    /* Hover effect to enlarge the image */
    .image-hover {
        transition: transform 0.3s ease-in-out;
    }

    .image-container:hover .image-hover {
        transform: scale(1.5); /* Adjust scale for desired zoom level */
    }
</style>

