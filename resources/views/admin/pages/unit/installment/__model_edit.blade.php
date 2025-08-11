<div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('Edit Installments ')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.unit-installments.update',$item->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="{{ $product->id }}" name="product_id">

                    <div class="card-body">
                        <div class="row">
                            <!-- Hidden Input for Project ID -->
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <!-- Input for Down Payment -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="price">{{ __('Price Unit') }}</label>
                                    <input type="number" step="0.01" id="price" name="price"
                                        class="form-control @error('price') is-invalid @enderror" value="{{ $product->price }}"
                                        readonly>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="price">{{ __('Deposit') }}</label>
                                    <input type="number" step="0.01" id="deposit" name="deposit"
                                        class="form-control @error('deposit') is-invalid @enderror" value="{{ old('deposit',$item->deposit) }}"
                                        required>
                                    @error('deposit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input for Years -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="years">{{ __('Years Count') }}</label>
                                    <input type="number" id="years" name="years"
                                        class="form-control @error('years') is-invalid @enderror" value="{{ old('years',$item->years) }}"
                                        required>
                                    @error('years')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Edit')}}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
