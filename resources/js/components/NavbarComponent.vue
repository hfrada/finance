<template>
	<div>
		<ul>
			<li><a v-on:click="$router.push('/dashboard').catch(()=>{})">dashboard</a></li>
			<li><a v-on:click="$router.push({name: 'categoryMain'}).catch(()=>{})">category</a></li>
		</ul>
	</div>
</template>