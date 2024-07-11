import { ChatTextarea } from 'im.v2.component.textarea';

import '../css/textarea.css';

// @vue/component
export const CommentsTextarea = {
	name: 'CommentsTextarea',
	components: { ChatTextarea },
	props:
	{
		dialogId: {
			type: String,
			default: '',
		},
	},
	template: `
		<ChatTextarea
			:dialogId="dialogId"
			:withMarket="false"
			class="bx-im-comments-send-panel__container"
		/>
	`,
};
