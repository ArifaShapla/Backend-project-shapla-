<!DOCTYPE html>
<html>
<head>
    <title>Daily Grocery Price Logger</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Daily Grocery Price Logger</h1>
            <a href="{{ route('grocery-items.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Log New Price
            </a>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <!-- Date Filter -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('grocery-items.index') }}">
                    <div class="row align-items-end">
                        <div class="col-md-4">
                            <label for="selected_date" class="form-label">Select Date:</label>
                            <select class="form-select" id="selected_date" name="selected_date" onchange="this.form.submit()">
                                @foreach($availableDates as $date)
                                    <option value="{{ $date }}" {{ $selectedDate == $date ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::parse($date)->format('M d, Y') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('grocery-items.index') }}" class="btn btn-secondary">Show Today</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Grocery Items Table -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Grocery Prices for {{ \Carbon\Carbon::parse($selectedDate)->format('F j, Y') }}</h5>
                
                @if($groceryItems->isEmpty())
                    <div class="alert alert-info">
                        No prices logged for this date. <a href="{{ route('grocery-items.create') }}">Log the first price!</a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Item Name</th>
                                    <th>Unit</th>
                                    <th>Price</th>
                                    <th>Date Logged</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($groceryItems as $item)
                                <tr>
                                    <td>{{ $item->item_name }}</td>
                                    <td>{{ $item->unit }}</td>
                                    <td>${{ number_format($item->price, 2) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->date_logged)->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('grocery-items.show', $item->id) }}" class="btn btn-info btn-sm" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('grocery-items.edit', $item->id) }}" class="btn btn-primary btn-sm" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('grocery-items.destroy', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this item?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>