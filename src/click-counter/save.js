import { RichText, useBlockProps } from '@wordpress/block-editor';
import ServerSideRender from '@wordpress/server-side-render';

export default function save( props, attributes ) {
    const blockProps = useBlockProps.save( { className: "marquee" } );
	return (
        <div {...blockProps}>
             <ServerSideRender
					block="bf-click-counter/click-counter"
					attributes={attributes}
				/>     
        </div>
	);
}