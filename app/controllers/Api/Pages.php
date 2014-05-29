<?php namespace Api;

class Pages extends ApiBaseController {

  public function getEdits($id) {
    $this->response['data'] = \CMS::getEditsForPage($id);
    return $this->getResponse();
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $this->response['code'] = 200;
    $this->response['data'] = \CMS::page()->getAll();
    return $this->getResponse();
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    $input = \Input::all();
    $validator = \Validator::make(
      $input,
      array(
        'name'           => 'required|',
        'url'            => 'required|alpha_dash',
        'h1'             => 'required|',
        'title'          => 'required|',
        'template_id'    => 'required|numeric',
        'active'         => 'numeric',
        'locked'         => 'numeric',
        'hidden'         => 'numeric'
      )
    );
    if($validator->fails()){
      return $this->validationError('Cannot create page', $validator->errors());
    }else{
      $page = \CMS::page()->create($input);
      $this->response['message'] = 'Page created';
      $this->response['data'] = $page->toArray();
      return $this->getResponse();
    }

  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    $input = \Input::except('id', 'template');
    \CMS::page()->find($id)->update($input);
    $this->response['message'] = 'Page updated';
    return $this->getResponse();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    \CMS::page()->find($id)->delete();
    $this->response['message'] = 'Page deleted';
    return $this->getResponse();
  }

}