 <div class="col-md-4">

          <!-- Search Widget -->
          <div class="card mb-4">
            <h5 class="card-header">Search</h5>
            <div class="card-body">
                   <form name="search" action="search.php" method="post">
              <div class="input-group">
           
        <input type="text" name="searchtitle" class="form-control" placeholder="Search for..." required>
                <span class="input-group-btn">
                  <button class="btn btn-secondary" type="submit">Go!</button>
                </span>
              </form>
              </div>
            </div>
          </div>

          <!-- Categories Widget -->
          <div class="card my-4">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
                    @foreach(App\Category::where(['type'=> 1, 'parent_id'=> NULL, 'is_show'=> 1, 'deleted_at'=> NULL ])->get() as $category )
                    <li>
                      <a href="{{ url('/category/') }}/{{$category->id}}">{{$category->name}}</a>
                    </li>
                    @endforeach

                  </ul>
                </div>
       
              </div>
            </div>
          </div>

          <!-- Side Widget -->
          <div class="card my-4">
            <h5 class="card-header">Recent News</h5>
            <div class="card-body">
                  <ul class="mb-0">
                      <li>
                        <a href="">Bangladesh</a>
                    </li>
            
                </ul>
            </div>
          </div>

        </div>

      
      </div>
      <!-- /.row -->

    </div>