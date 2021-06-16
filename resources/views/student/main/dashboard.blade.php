@extends('student/layouts/app')
@section('indicator')
    Dashboard
@endsection
@section('content')
    {{-- CONTENT --}}
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Test Results</h3>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Test Name</th>
                                <th scope="col" class="sort" data-sort="budget">Type</th>
                                <th scope="col" class="sort" data-sort="status">Score</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <tr>
                                <th scope="row">
                                    <div class="media-body">
                                        <span class="name mb-0 text-sm">English Course</span>
                                    </div>
                </div>
                </th>
                <td class="budget">
                    Pre-Test
                </td>
                <td>
                    <span class="badge badge-dot mr-4">
                        <span class="status">80</span>
                    </span>
                </td>
                <td>
                    <span>12-12-2000</span>
                </td>
                </tr>
                <tr>
                    <th scope="row">
                        <div class="media-body">
                            <span class="name mb-0 text-sm">English Course</span>
                        </div>

                    </th>
                    <td class="budget">
                        Post-Test
                    </td>
                    <td>
                        <span class="badge badge-dot mr-4">
                            <span class="status">90</span>
                        </span>
                    </td>
                    <td>
                        <span>10-09-2020</span>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <div class="media-body">
                            <span class="name mb-0 text-sm">TEFL</span>
                        </div>

                    </th>
                    <td class="budget">
                        Reading
                    </td>
                    <td>
                        <span class="badge badge-dot mr-4">
                            <span class="status">20</span>
                        </span>
                    </td>
                    <td>
                        <span>20-12-2021</span>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <span class="name mb-0 text-sm">English Course</span>
                            </div>
                        </div>
                    </th>
                    <td class="budget">
                        Repost-Test
                    </td>
                    <td>
                        <span class="badge badge-dot mr-4">
                            <span class="status">55</span>
                        </span>
                    </td>
                    <td>
                        <span>10-10-2010</span>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <span class="name mb-0 text-sm">TEFL</span>
                            </div>
                        </div>
                    </th>
                    <td class="budget">
                        Listening
                    </td>
                    <td>
                        <span class="badge badge-dot mr-4">
                            <span class="status">100</span>
                        </span>
                    </td>
                    <td>
                        <span>05-04-2011</span>
                    </td>
                </tr>
                </tbody>
                </table>

                <!-- Card footer -->
                <div class="card-footer py-4">
                    <nav aria-label="">
                        <ul class="pagination justify-content-end mb-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">
                                    <i class="fas fa-angle-left"></i>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">
                                    <i class="fas fa-angle-right"></i>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection