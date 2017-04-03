@extends('layouts.main.index', ['page_active' => 'emails'])
@section('title', 'Emails')
@section('page-title', 'Emails')
@section('stylesheets')
@endsection
@section('content')
  <div class="clearfix">
    <div class="row">
      <div class="col">
        <table class="table table-hover">
          <thead>
            <th>Date</th>
            <th>From</th>
            <th>Subject</th>
            <th>Content</th>
            <th>Tools</th>
          </thead>
          <tbody>
            @foreach ($mails as $key => $mail)
              <tr>
                <td class="align-middle">{{ $mail->date }}</td>
                <td class="align-middle">{{ $mail->headers->from[0]->personal }}</td>
                <td class="align-middle"><b>{{ substr(strip_tags($mail->headers->subject), 0, 20) }}{{ strlen(strip_tags($mail->headers->subject)) > 20 ? '...' : "" }}<b></td>
                <td class="align-middle">{{ substr(strip_tags($mail->textPlain), 0, 40) }}{{ strlen(strip_tags($mail->textPlain)) > 40 ? '...' : "" }}</td>
                <td class="align-middle">
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" name="button" class="btn btn-info">Read</button>
                    <button type="button" name="button" class="btn btn-danger">Delete</button>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
