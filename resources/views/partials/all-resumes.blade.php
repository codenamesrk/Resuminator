                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th></th>
                                    <th>File name</th>             
                                    <th>Location</th>
                                    <th>User email</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($resumes as $index => $resume)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    @if($resume->parent != 0)                                    
                                    <td></td><td><i class="fa fa-minus"></i></td>
                                    @else
                                    <td><i class="fa fa-plus"></i></td><td></td>
                                    @endif
                                    
                                    <td>{{ $resume->name }}</td>
                                    <td>{{ $resume->original_name }}</td>
                                    <td>{{ $resume->user->email }}</td>
                                    <td>{{ $resume->created_at }}</td> 
                                
                                    @if( $resume->review->name === 'reviewing' )                                       
                                        <td><a href="{{ route('admin::dashboard.edit.report', ['report' => $resume->report->id ]) }}" class="btn btn-sm btn-danger">Draft</a></td>
                                    @elseif( $resume->review->name === 'reviewed' )
                                        <td><a href="#" class="btn btn-sm btn-success disabled">Completed</a></td>
                                    @else
                                        <td><a href="{{ route('admin::dashboard.review', ['resume' => $resume->id ]) }}" class="btn btn-sm btn-info">Review</a></td>
                                    @endif                                        
                                </tr>
                                @endforeach
                            </tbody>
                        </table>