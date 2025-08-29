<!DOCTYPE html>
<html>
<head>
    <title>Log Grocery Price</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Log New Grocery Price</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('grocery-items.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="item_name" class="form-label">Item Name</label>
                                <input type="text" class="form-control" id="item_name" name="item_name" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="unit" class="form-label">Unit</label>
                                <select class="form-select" id="unit" name="unit" required>
                                    <option value="">Select Unit</option>
                                    <option value="kg">Kilogram (kg)</option>
                                    <option value="g">Gram (g)</option>
                                    <option value="lb">Pound (lb)</option>
                                    <option value="piece">Piece</option>
                                    <option value="pack">Pack</option>
                                    <option value="liter">Liter</option>
                                    <option value="ml">Milliliter (ml)</option>
                                    <option value="dozen">Dozen</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="price" class="form-label">Price ($)</label>
                                <input type="number" step="0.01" class="form-control" id="price" name="price" min="0" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="date_logged" class="form-label">Date</label>
                                <input type="date" class="form-control" id="date_logged" name="date_logged" value="{{ $defaultDate }}" required>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('grocery-items.index') }}" class="btn btn-secondary me-md-2">Cancel</a>
                                <button type="submit" class="btn btn-primary">Log Price</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>