{{-- <x-app-layout> --}}
<div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    {{-- expense heading --}}
    <div class="container-fluid p-0 ">
        <div class="row">
            <div class="col sm-12">
                <h5 class="bg">Expense Management</h5>
            </div>
        </div>
    </div>
    {{-- second colum --}}
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="clr text-center">
                    <h5 class="pt-3">Available Budget in Augest-08-2021</h5>
                    <h1 class="pt-2" style="font-size: 55px">{{ $restamount }}</h1>
                    <p class="clr1 text-justify pt-2 pl-2">
                        Income&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $addincomes }}
                    </p>
                    <p class="clr1 text-justify pt-2 pl-2 mt-3" style="background-color: red">
                        Expenses&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $addexpenses }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    {{-- value add section --}}
    <div class="container-fluid">
        <div class="row">
            <div class="box">
                <div class="col sm-6">
                    @if ($modal)
                        @include('edit')
                    @else
                        <form>
                            <div class="row">
                                <div class="col-sm-6 pt-3">
                                    <label for="">Name:</label>
                                    <input type="text" class="form-control" name="name"
                                        placeholder="Example food,salary,shopping" wire:model="name">
                                    <div class="alert-danger">
                                        {{ $errors->first('name') }}
                                    </div>
                                </div>
                                <div class="col-sm-6 pt-3">
                                    <label for="">Amount:</label>
                                    <input type="text" class="form-control" name="amount" placeholder="amount"
                                        wire:model="amount">
                                        <div class="alert-danger">
                                            {{ $errors->first('amount') }}
                                        </div>
                                </div>
                                <div class="col-sm-6 pt-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                            id="inlineRadio1" value="income" wire:model="income">
                                        <label class="form-check-label" for="inlineRadio1">Incomes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                            id="inlineRadio2" value="expense" wire:model="expense">
                                        <label class="form-check-label" for="inlineRadio2">Expenses</label>
                                    </div>
                                </div>
                                <div class="col-sm-6 pt-3">
                                    <label for="">Date:</label>
                                    <input type="date" class="form-control" name="date" wire:model="date">
                                    <div class="alert-danger">
                                        {{ $errors->first('date') }}
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label for="">Desciprtion:</label><br>
                                    <textarea class="form-cotrol w-100" rows="4" name="description"
                                        placeholder="Write a detail note" wire:model="description" required></textarea>
                                        <div class="alert-danger">
                                            {{ $errors->first('description') }}
                                        </div>
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-outline-info w-100 mt-3 mb-3"
                                        wire:click.prevent="store()">Add
                                        Details</button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
            {{-- pie chart section --}}
            <div class="col-sm-6">
                <div id="piechart" style="width: 600px; height: 400px;" class="
                mt-3"> <svg>
                        <rect fill: #f3f4f6;> </rect>
                    </svg></div>


            </div>
        </div>
    </div>
    {{-- income table --}}
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-sm-6">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col" style="color: rgb(53, 202, 240)">Income</th>
                            <th scope="col" style="color: rgb(53, 202, 240)">Name</th>
                            <th scope="col" style="color: rgb(53, 202, 240)">Amount</th>
                            <th scope="col" style="color: rgb(53, 202, 240)">Operations</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inc as $i)
                            <tr>
                                <th scope="row">{{ $i->id }}</th>
                                <td>{{ $i->name }}</td>
                                <td>{{ $i->amount }}</td>
                                <td><button type="button" class="btn btn-info"
                                        wire:click="editincome({{ $i->id }})">Edit</button>
                                    <button type="button" class="btn btn-danger" onclick="del()"
                                        wire:click="delete({{ $i->id }})">Delete</button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            {{-- expense table --}}
            <div class="col-sm-6">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col" style="color: red">Expense</th>
                            <th scope="col" style="color: red">Name</th>
                            <th scope="col" style="color: red">Amount</th>
                            <th scope="col" style="color: red">Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($exp as $e)
                            <tr>
                                <th scope="row">{{ $e->id }}</th>
                                <td>{{ $e->name }}</td>
                                <td>{{ $e->amount }}</td>
                                <td><button type="button" class="btn btn-info"
                                        wire:click="editexpenses({{ $e->id }})">Edit</button>
                                    <button type="button" class="btn btn-danger" onclick="dele()"
                                        wire:click="deletee({{ $e->id }})">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function alertfunction() {
        alert('Data Submitted');
    }

    function del() {
        alert('Delete Sucessfully');
    }

    function dele() {
        alert('Delete Sucessfully');
    }
</script>
{{-- </x-app-layout> --}}
<html>

<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Income', 4],
                ['Expense', 2],

            ]);

            var options = {
                title: 'My Daily Activities'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
</head>

<body>

</body>

</html>
