<section class="panel modal lg" id="edit">
    <header>
        <div class="title"><span class="icon-close"></span>ویرایش وضعیت سفارش</div>
        <div class="functions">

        </div>
    </header>
    <form action="{{url('shopping/shoppingStatusEdit')}}" method="POST">
        {!! csrf_field() !!}
        <input type="hidden" name="invoice_id" value="" class="invoice_id">
        <article>
            <div class="field">
                <label for="shopping_status">
                    <span class="icon-tags"></span> وضعیت سفارش </label>
                <div class="select col-md-12">
                    <select class="status" name="shopping_status" id="shopping_status">
                        <option value="0">درحال بررسی</option>
                        <option value="1">تحویل به پیک</option>
                        <option value="2">تحویل به مشتری</option>
                    </select>
                </div>
            </div>
        </article>
        <article>
            <button class="purple" type="submit"> بروزرسانی</button>
        </article>
    </form>
</section>