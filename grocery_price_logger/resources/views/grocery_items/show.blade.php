<!DOCTYPE html>
<html>
<head>
    <title>Grocery Price Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Grocery Price Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Item Name:</strong>
                            <p class="form-control-static">{{ $groceryItem->item_name }}</p>
                        </div>
                        
                        <div class="mb-3">
                            <strong>Unit:</strong>
                            <p class="form-control-static">{{ $groceryItem->unit }}</p>
                        </div>
                        
                        <div class="mb-3">
                            <strong>Price:</strong>
                            <p class="form-control-static">${{ number_format($groceryItem->price, 2) }}</p>
                        </div>
                        
                        <div class="mb-3">
                            <strong>Date Logged:</strong>
                            <p class="form-control-static">{{ $groceryItem->date_logged->format('F j, Y') }}</p>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('grocery-items.index') }}" class="btn btn-primary">Back to List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>