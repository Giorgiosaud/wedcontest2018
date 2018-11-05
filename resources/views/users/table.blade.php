<table>
  <thead>
    <tr>
      <th>Type</th>
      <th>Id</th>
      <th>Name</th>
      <th>LastName</th>
      <th>Email</th>
      <th>Country</th>
      <th>Phone</th>
      <th>Referred Type</th>
      <th>Referred by</th>
      <th>Language</th>
      <th>Comments</th>
      <th>Created At</th>
      <th>Contestant Category</th>
      <th>Contestant Slug</th>
    </tr>
  </thead>
  <tbody> 
  @foreach ($users as $user)
    <tr>
      <td>Representant</td>
      <td>{{$user->id}}</td>
      <td>{{$user->name}}</td>
      <td>{{$user->last_name}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->country}}</td>
      <td>{{$user->phone}}</td>
      <td>{{$user->referred}}</td>
      <td>{{$user->referred_specify}}</td>
      <td>{{$user->language}}</td>
      <td>{{$user->comments}}</td>
      <td>{{$user->created_at}}</td>
    </tr>
    @foreach ( $user->contestants as $contestant )
      <tr>
        <td>Contestant</td>
        <td>{{$contestant->id}}</td>
        <td>{{$contestant->name}}</td>
        <td>{{$contestant->last_name}}</td>
        <td>{{$contestant->email}}</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>{{$contestant->categories[0]->name}}</td>
        <td>{{$contestant->slug}}</td>
      </tr>
    @endforeach
  @endforeach
  </tbody>
</table>