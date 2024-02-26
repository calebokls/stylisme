@extends('styliste.layout')
@section('content')
<h1>Creation</h1>

<div class="col-md-12">
                  <div class="card mb-4">
                    <div class="card-body demo-vertical-spacing demo-only-element">
                      <div class="form-password-toggle">
                        <label class="form-label" for="basic-default-password32">Password</label>
                        <div class="input-group input-group-merge">
                          <input
                            type="password"
                            class="form-control"
                            id="basic-default-password32"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="basic-default-password" />
                          <span class="input-group-text cursor-pointer" id="basic-default-password"
                            ><i class="bx bx-hide"></i
                          ></span>
                        </div>
                      </div>

                      <div class="input-group input-group-merge">
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Recipient's username"
                          aria-label="Recipient's username"
                          aria-describedby="basic-addon33" />
                        <span class="input-group-text" id="basic-addon33">@example.com</span>
                      </div>

                      <div class="input-group input-group-merge">
                        <span class="input-group-text" id="basic-addon34">https://example.com/users/</span>
                        <input type="text" class="form-control" id="basic-url3" aria-describedby="basic-addon34" />
                      </div>

                      <div class="input-group input-group-merge">

                        <div class="row gy-3">
                        <div class="col-md">
                          <small class="text-light fw-medium d-block">Genre</small>
                          <div class="form-check form-check-inline mt-3">
                            <input
                              class="form-check-input"
                              type="radio"
                              name="inlineRadioOptions"
                              id="inlineRadio1"
                              value="option1" />
                            <label class="form-check-label" for="inlineRadio1">femme</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input
                              class="form-check-input"
                              type="radio"
                              name="inlineRadioOptions"
                              id="inlineRadio2"
                              value="option2" />
                            <label class="form-check-label" for="inlineRadio2">homme</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input
                              class="form-check-input"
                              type="radio"
                              name="inlineRadioOptions"
                              id="inlineRadio3"
                              value="option3" />
                            <label class="form-check-label" for="inlineRadio3">mixte</label>
                          </div>
                        </div>
                      </div>

                      </div>

                      <div class="input-group input-group-merge">
                        <span class="input-group-text">With textarea</span>
                        <textarea class="form-control" aria-label="With textarea"></textarea>
                      </div>
                    </div>
                  </div>
  </div>

@endsection
