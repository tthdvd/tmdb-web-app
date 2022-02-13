import React from "react";
import {CircularProgress, Grid} from "@mui/material";

const Loading = () => {
    return <Grid container justifyContent={"center"}>
        <Grid item>
            <CircularProgress/>
        </Grid>
    </Grid>
}

export default Loading
