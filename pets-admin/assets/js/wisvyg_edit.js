function initTiny() {
  tinymce.init({
    selector: 'textarea#content',
    setup: function (editor) {
      editor.on('change', function () {
        editor.save()
      })
    },
    plugins:
      'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
    imagetools_cors_hosts: ['picsum.photos'],
    menubar: 'file edit view insert format tools table help',
    toolbar:
      'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
    toolbar_sticky: true,
    autosave_ask_before_unload: true,
    autosave_interval: '30s',
    autosave_prefix: '{path}{query}-{id}-',
    autosave_restore_when_empty: false,
    autosave_retention: '2m',
    image_advtab: true,
    mode: 'textareas',
    theme_advanced_buttons3_add: 'save',
    save_enablewhendirty: true,
    save_onsavecallback: 'mysave',

    templates: [
      {
        title: 'Reference',
        description: 'creates a new table',
        content: `

  <div class="custom_accordian_section acrd_2">
   <div id="accordionFlushExample" class="accordion accordion-flush">
      <div class="accordion-item">
         <span id="flush-headingOne" class="accordion-header" style="font-weight: 600; font-size: 18px;"> 
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne1" aria-expanded="false" aria-controls="flush-collapseOne1"> References </button> 
        </span>
         <div id="flush-collapseOne1" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
               <ul class="list-unstyled accordian_ul">
                  <li class="accordian_ul_list_items">
                     <div class="d-flex gap-3 align-items-center">
                        01 <h2>Compared To Other Vaccines</h2>
                     </div>
                     <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium odio doloribus sint ratione labore tenetur itaque harum autem animi suscipit, ipsam, enim nemo illum neque quibusdam repudiandae. Consectetur, eius minima?</p>
                  </li>

                  <li class="accordian_ul_list_items">
                     <div class="d-flex gap-3 align-items-center">
                        02 <h2>Compared To Other Vaccines</h2>
                     </div>
                     <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium odio doloribus sint ratione labore tenetur itaque harum autem animi suscipit, ipsam, enim nemo illum neque quibusdam repudiandae. Consectetur, eius minima?</p>
                  </li>

                  <li class="accordian_ul_list_items">
                     <div class="d-flex gap-3 align-items-center">
                        03 <h2>Compared To Other Vaccines</h2>
                     </div>
                     <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium odio doloribus sint ratione labore tenetur itaque harum autem animi suscipit, ipsam, enim nemo illum neque quibusdam repudiandae. Consectetur, eius minima?</p>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</div>
<hr>
<p></p>
        
      `,
      },
      {
        title: 'FAQ',
        description: 'creates a new table',
        content: `<div class="custom_accordian_section">
      <h4>FAQ's</h4>
      <div class="accordion" id="accordionExample">
        <div class="accordion-item">
          <span class="accordion-header" id="headingOne" style="font-weight:600;font-size:18px;">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
              <span class="me-3">01</span>
              Compare to other vaccines
            </button>
          </span>
          <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
            <div class="accordion-body">
              <strong>This is the first item's accordion body.</strong>
              It is shown by default, until the collapse plugin adds the
              appropriate classes that we use to style each element.
              These classes control the overall appearance, as well as
              the showing and hiding via CSS transitions. You can modify
              any of this with custom CSS or overriding our default
              variables. It's also worth noting that just about any HTML
              can go within the <code>.accordion-body</code>, though the
              transition does limit overflow.
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <span class="accordion-header" id="headingTwo" style="font-size:18px;font-weight:600;">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              <span class="me-3">02</span>
              Compare to other vaccines
            </button>
          </span>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <strong>This is the second item's accordion body.</strong>
              It is hidden by default, until the collapse plugin adds
              the appropriate classes that we use to style each element.
              These classes control the overall appearance, as well as
              the showing and hiding via CSS transitions. You can modify
              any of this with custom CSS or overriding our default
              variables. It's also worth noting that just about any HTML
              can go within the <code>.accordion-body</code>, though the
              transition does limit overflow.
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <span class="accordion-header" id="headingThree" style="font-weight:600;font-size:18px;">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              <span class="me-3">03</span>
              Compare to other vaccines
            </button>
          </span>
          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <strong>This is the third item's accordion body.</strong>
              It is hidden by default, until the collapse plugin adds
              the appropriate classes that we use to style each element.
              These classes control the overall appearance, as well as
              the showing and hiding via CSS transitions. You can modify
              any of this with custom CSS or overriding our default
              variables. It's also worth noting that just about any HTML
              can go within the <code>.accordion-body</code>, though the
              transition does limit overflow.
            </div>
          </div>
        </div>
       

      </div>
    </div>
    <hr>
    <p></p>`,
      },

      {
        title: 'Quote',
        description: 'creates a new table',
        content: `
    <div class="highlighted_section mx-1 my-4">
    <p class="" id="h1">
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore
      eligendi numquam vero vel itaque quae.
    </p>
  </div>
    `,
      },
      {
        title: 'Two Column Image',
        description: 'creates a new table',
        content: `
    <div class="img_with_para my-4 row d-block d-md-flex">
              <div class="col mb-4 mb-md-0">
                <img src="https://web-static.wrike.com/blog/content/uploads/2016/11/iStock-492785970.jpg?av=f9b41860b73b93b38b906a96accd10e2" alt="">
              </div>
              <div class="col">
                <p>
                  Lorem, ipsum dolor sit amet consectetur adipisicing elit. Amet
                  natus facere, ratione ut non, maxime voluptates id pariatur
                  dolorem officia, repellendus illum libero modi nisi
                  reprehenderit asperiores sint ullam necessitatibus.
                </p>
              </div>
            </div>
            <hr>
            <p></p>
    `,
      },
      {
        title: 'Three Column Image',
        description: 'creates a new table',
        content: `
    <div class="img_with_para my-4 row d-block d-md-flex">
              <div class="col mb-4 mb-md-0">
                <img src="https://web-static.wrike.com/blog/content/uploads/2016/11/iStock-492785970.jpg?av=f9b41860b73b93b38b906a96accd10e2" alt="">
              </div>
              <div class="col">
                  Lorem, ipsum dolor sit amet consectetur adipisicing elit. Amet
                  natus facere, ratione ut non, maxime voluptates id pariatur
                  dolorem officia, repellendus illum libero modi nisi
                  reprehenderit asperiores sint ullam necessitatibus.
              </div>
            </div>
            <div>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum
              quas ipsam maxime magnam, reiciendis consequuntur voluptatum
              dignissimos. Ratione sint corrupti quia neque adipisci? Quos saepe
              impedit cupiditate eius nam commodi?
            </div>
            <hr>
            <p></p>
    `,
      },
    ],
    template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
    template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
    height: 600,
    image_caption: true,
    quickbars_selection_toolbar:
      'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    noneditable_noneditable_class: 'mceNonEditable',
    toolbar_mode: 'sliding',
    contextmenu: 'link image imagetools table',
    content_style:
      'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
  })
}
initTiny()

$('.tox-tinymce .tox-menubar').append(
  '<button aria-haspopup="true" role="menuitem" type="button" tabindex="-1" data-alloy-tabstop="true" unselectable="on" class="tox-mbtn tox-mbtn--select" aria-expanded="false" style="user-select: none;"><span class="tox-mbtn__select-label">File</span><div class="tox-mbtn__select-chevron"><svg width="10" height="10" focusable="false"><path d="M8.7 2.2c.3-.3.8-.3 1 0 .4.4.4.9 0 1.2L5.7 7.8c-.3.3-.9.3-1.2 0L.2 3.4a.8.8 0 010-1.2c.3-.3.8-.3 1.1 0L5 6l3.7-3.8z" fill-rule="nonzero"></path></svg></div></button>',
)
