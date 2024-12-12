<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="container my-5">
    <!-- Header Section -->
    <div class="text-center mb-4">
        <h1 class="fw-bold text-success">SNGK Online Fashion Store</h1>
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
                    <!-- Change col-md-4 to col-md-3 for 4 cards per row -->
                    <div class="col-md-3">
                        <div class="card border shadow-sm">
                            <div class="card-body p-3">
                                <!-- Static Image Preview -->
                                <div class="mb-3 text-center">
                                    <!-- <img src="https://images.pexels.com/photos/458669/pexels-photo-458669.jpeg" 
                                         alt="Preview Image" 
                                         class="img-fluid rounded" 
                                         style="max-height: 150px;"> -->

                                         <img src="{{ $file['url'] }}{{ $file['name'] }}" 
                                                alt="{{ $file['name'] }}" 
                                                class="img-fluid rounded" 
                                                style="max-height: 150px;">
                                </div>

                                <!-- File Name with Left Alignment and Font Change -->
                                <h5 class="card-title text-dark" style="font-family: 'Arial', sans-serif; text-align: left;">
                                    {{ $file['name'] }}
                                </h5>

                                <!-- Action Buttons -->
                                <div class="d-flex justify-content-start gap-2 mt-3">
                                    <!-- Download Button -->
                                    <a href="{{ url($file['downloadUrl']) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fa-solid fa-download"></i> Download
                                    </a>
                                    <!-- Delete Button -->
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
    .card:hover {
        transform: scale(1.03);
        transition: all 0.3s ease-in-out;
    }

    /* Image Preview */
    .img-fluid {
        object-fit: cover;
    }

    /* Reduce button width and align them to the left */
    .btn {
        width: auto; /* Set the width to auto for buttons */
        height: 38px; /* Ensure the height is consistent */
    }

    .d-flex {
        display: flex;
        justify-content: flex-start; /* Align buttons to the left */
    }

    .gap-2 {
        gap: 10px; /* Add spacing between buttons */
    }

    /* Style for cards: No background color, small border and shadow */
    .card {
        background-color: transparent; /* Remove background color */
        border: 1px solid #ddd; /* Add light border */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Add small shadow */
    }

    /* Custom font for file name */
    .card-title {
        font-family: 'Arial', sans-serif;
        font-size: 16px;
    }
</style>
