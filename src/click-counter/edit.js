import { __ } from '@wordpress/i18n';
import { RichText, useBlockProps, InspectorControls } from '@wordpress/block-editor';
import {
	PanelBody,
	TextControl
} from '@wordpress/components';
import ServerSideRender from '@wordpress/server-side-render';
export default function Edit( props ) {
    const blockProps = useBlockProps();
    const { attributes, setAttributes } = props;
    const content = props.attributes.content;
    const { counterKey } = props.attributes;

    function onChangeContent( newContent ) {
        props.setAttributes( { content: newContent } );
    }
    console.log(blockProps);
    return (
        <>
        <InspectorControls>
        <PanelBody title={__('Counter setting', 'bf-click-counter')}>
        <TextControl
                    label={__('Counter Key', 'bf-click-counter')}
                    value={counterKey}
                    className={`mt-0 mb-3`}
                    onChange={(value) =>
                        setAttributes({ counterKey: value })
                    }
                    placeholder={'Counter Key'}
                />
        </PanelBody>
        </InspectorControls>
            <ServerSideRender
					block="bf-click-counter/click-counter"
					attributes={attributes}
                    classnames={blockProps.className}
				/>
        </>
    );
}