(function(blocks, editor, element){
    var el = element.createElement;

    blocks.registerBlockType('ddab/dd-about', {
        title: 'DD About',
        icon: 'admin-comments',
        category: 'common',
        attributes: {
            title: {
                type: 'string',
                default: 'Block Title',
            },
            content: {
                type: 'string',
                default: 'Hello World',
            },
        },
        edit: function(props){
            return (
                el('div', {className: props.className},
                    el(
                        editor.RichText,
                        {
                            tagName: 'h2',
                            className: 'dd-about-title',
                            value: props.attributes.title,
                            onChange: function (content) {
                                props.setAttributes({title:content});
                            }
                        }
                    ),
                    el(
                        editor.RichText,
                        {
                            tagName: 'div',
                            className: 'dd-about-text',
                            value: props.attributes.content,
                            onChange: function (content) {
                                props.setAttributes({content:content});
                            }
                        }
                    ),
                )
            );
        },
        save: function(props){
            return (
                el('div', {className: props.className}, 
                    el(
                        editor.RichText.Content, 
                        {
                            tagName: 'h2',
                            className: 'dd-about-title',
                            value: props.attributes.title,
                        }
                    ),
                    el(
                        editor.RichText.Content, 
                        {
                            tagName: 'div',
                            className: 'dd-about-text',
                            value: props.attributes.content,
                        }
                    ),
                )
            );
        },
    })

})(window.wp.blocks,window.wp.editor,window.wp.element);